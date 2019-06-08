function reportWidgetError(widget, context, error) {
    console.warn(context, error, widget);   
}

function getModelWidgets() {
    return document.getElementsByClassName('hat-model-widget');
}

function initModelWidgets() {
    var widgets = getModelWidgets();

    for (var widget of widgets) {
        var modelUrl = widget.getAttribute('data-model-url');
        if (!modelUrl) {
            console.warn('Model widget exists without data about model URL', widget);   
            continue;
        }

        init_gltf_viewer(widget, modelUrl);
    }
}

dom_ready(initModelWidgets);