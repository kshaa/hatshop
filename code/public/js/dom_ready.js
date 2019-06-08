function dom_ready(callback) {
    if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
        callback();
    } else {
        document.addEventListener('DOMContentLoaded', callback);
    }
}  