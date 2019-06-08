<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Auth;
use App\Hat;
use Illuminate\Support\Facades\Storage;
use Chumper\Zipper\Zipper;

class HatController extends Controller
{
    /**
     * List all user hats
     */
    public function index() {
        $userHats = Auth::user()->ownedHats()->get();

        return view('hat/index', array('hats' => $userHats));
    }

    /**
     * Show info about a specific hat
     */
    public function show($id) {
        $hat = Hat::findOrFail($id);
        $owner = $hat->owner()->first();
        $creator = $hat->creator()->first();

        return view('hat/show', [
            'hat' => $hat,
            'owner' => $owner,
            'creator' => $creator
        ]);
    }

    /**
     * Serve new hat form
     */
    public function new() {
        return view('hat/new');
    }


    /**
     * Edit a hat
     */
    public function edit($id) {
        $hat = Hat::findOrFail($id);

        return view('hat/edit', [ 'hat' => $hat ]);
    }

    /**
     * Update a hat
     */
    public function update(Request $request, $id) {
        # Validate data
        $hat = Hat::findOrFail($id);
        $ruleMessages = $hat->ruleMessages;
        $originalRules = $hat->rules;
        $rules = [];
        $rules['label'] = $originalRules['label'];
        $rules['description'] = $originalRules['description'];
        $validatedData = $request->validate(
            $rules,
            $ruleMessages
        );

        # Update and save model
        $hat->label = $validatedData['label'];
        $hat->description = $validatedData['description'];
        $hat->save();

        # Respond with a redirect to the newly created model
        return redirect()->route('hat_show', ['id' => $hat->id]);
    }

    /**
     * Serve new hat form
     */
    public function create(Request $request) {
        # Validate data
        $hat = Hat::make();
        $ruleMessages = $hat->ruleMessages;
        $rules = $hat->rules;
        ## Remove data generated later in this controller from validation list
        unset($rules['creator_id']);
        unset($rules['owner_id']);
        unset($rules['model_path']);
        $validatedData = $request->validate(
            $rules,
            $ruleMessages
        );

        # Store hat model
        try {
            $modelPath = $this->storeModelArchive($request->file('model_archive'));
        } catch(ValidationException $validationException) {
            // Pass self-created exceptions along
            throw $validationException;
        } catch (Exception $exception) {
            // Pass unknown exceptions with a custom name
            throw ValidationException::withMessages([
                'model_file' => ['Model archive processing failed.'],
            ]);
        }

        # Create and save model
        $user = Auth::user();
        $hat->label = $validatedData['label'];
        $hat->description = $validatedData['description'];
        $hat->code = $validatedData['code'];
        $hat->model_path = $modelPath;
        $hat->creator_id = $user->id;
        $hat->owner_id = $user->id;
        $hat->save();

        # Respond with a redirect to the newly created model
        return redirect()->route('hat_show', ['id' => $hat->id]);
    }

    /**
     * Delete a hat
     */
    public function delete($id) {
        $hat = Hat::findOrFail($id);
        $hat->delete();

        return redirect()->route('hat_index');
    }

    /**
     * Store uploaded model archive
     * - Store the archive in a unique path
     * - Extract all data from the archive
     * - Return path to the GLTF file
     */
    public function storeModelArchive($modelArchive) {
        # Store the archive in a unique path
        $hashBasename = pathinfo($modelArchive->hashName(), PATHINFO_FILENAME);
        $hashName = $hashBasename . '.gltf';
        $archiveDirname = 'public/model/' . $hashBasename;
        $archiveFilename = Storage::putFileAs($archiveDirname, $modelArchive, 'archive.zip', 'public');

        # Report if failed to store model
        if ($archiveFilename === false) {
            throw ValidationException::withMessages([
                'model_file' => ['Internal server error: Failed to store model archive.'],
            ]);
        }

        # Search for path to the GLTF file 
        $pathPrefix = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $absoluteArchiveFilename = $pathPrefix . $archiveFilename;
        $absoluteArchiveDirname = $pathPrefix . $archiveDirname;
        $archive = new Zipper;
        ## This method can either create or open an archive
        $archive->make($absoluteArchiveFilename);

        $archiveFiles = $archive->listFiles();
        $gltfPath = NULL;
        foreach ($archiveFiles as $archiveFile) {
            if ($this->textEndsWith($archiveFile, '.gltf')) {
                $gltfPath = $archiveDirname . '/' . $archiveFile;
            }
        }

        # Report if failed to store model
        if ($gltfPath === NULL) {
            throw ValidationException::withMessages([
                'model_file' => ["Couldn't find '.gltf' file in archive."],
            ]);
        }

        # Extract data from archive
        $archive->extractTo($absoluteArchiveDirname); 

        # Return path to the GLTF file
        return $gltfPath;
    }

    private function textEndsWith($text, $endsWith) {
        $length = strlen($endsWith);
        if ($length == 0) {
            return true;
        }
    
        return (substr($text, -$length) === $endsWith);
    }
}
