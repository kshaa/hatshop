"use strict";

function resizeUpdate(resizeContext) {
    let {
        container,
        canvas,
        camera,
        renderer
    } = resizeContext;
    const width = container.clientWidth;
    const height = container.clientHeight;

    if (canvas.width !== width || canvas.height !== height) {
        // you must pass false here or three.js sadly fights the browser
        renderer.setSize(width, height, false);
        camera.aspect = width / height;

        camera.position.set(20, 5, 50);
        camera.lookAt(new THREE.Vector3(0, 0, 0));

        window.camera = camera;

        camera.updateProjectionMatrix(); 
    }
}    

function tagBadContainer(container) {
    container.classList.add('failed-render');
}

// simplified on three.js/examples/webgl_loader_gltf2.html                        
function init_gltf_viewer(container, gltfUrl) {
    // renderer                                                                 
    const renderer = new THREE.WebGLRenderer({antialias: true});
    const canvas = renderer.domElement;

    // camera                                                                   
    const camera = new THREE.PerspectiveCamera(30, 800 / 600, 1, 10000);

    // resize
    const resizeContext = {
        container,
        canvas,
        camera,
        renderer
    };
    resizeUpdate(resizeContext);
    container.appendChild(renderer.domElement);

    // scene and lights                                                         
    const scene = new THREE.Scene();
    scene.background = new THREE.Color( 0xffffff );
    scene.add(new THREE.AmbientLight(0xdddddd));


    var sunLight = new THREE.DirectionalLight(0xd63710, 10);
    sunLight.position.set(-300, 100, -400);
    sunLight.position.multiplyScalar(5.0);
    sunLight.castShadow = true;
    sunLight.shadowMapWidth = 512;
    sunLight.shadowMapHeight = 512;
    sunLight.lookAt( new THREE.Vector3(0,0,0) );


    // load gltf model and texture                            
    const objs = [];
    const loader = new THREE.GLTFLoader();
    loader.load(gltfUrl, gltf => {
        // model is a THREE.Group (THREE.Object3D)                              
        const mixer = new THREE.AnimationMixer(gltf.scene);
        // animations is a list of THREE.AnimationClip
        for (const anim of gltf.animations) {
            mixer.clipAction(anim).play();
        }
        // settings in `sceneList` "Monster"
        // gltf.scene.scale.set(0.4, 0.4, 0.4);
        // gltf.scene.rotation.copy(new THREE.Euler(0, -3 * Math.PI / 4, 0));
        // gltf.scene.position.set(2, 1, 0);

        gltf.scene.traverse( function ( child ) {
            if ( child.isMesh ) {
                child.geometry.center(); // center here
            }
        });
        gltf.scene.scale.set(1,1,1) // scale here
        
        scene.add(gltf.scene);
        objs.push({gltf, mixer});

        resizeUpdate(resizeContext);
    }, null, () => {
        tagBadContainer(container);
    });

    // animation rendering                                                      
    const clock = new THREE.Clock();
    (function animate() {
        // animation with THREE.AnimationMixer.update(timedelta)                
        objs.forEach(({mixer}) => {mixer.update(clock.getDelta());});
        renderer.render(scene, camera);
        requestAnimationFrame(animate);
    })();

    // on window resize, resize scene
    window.addEventListener( 'resize', function() {
        resizeUpdate(resizeContext);
    }, false);

    return objs;
};


