// via mutationobserver watch for any new colorpicker fields and add the color palette
// to them
(function () {
    const ColorPaletteField = (node) => {
        // check to see if this node is a react version, if no then we're done.
        const labels = node.querySelectorAll(".form-check-label");
        const isReact = labels.length > 0;

        if (!isReact) {
            return;
        }

        // set a background attribute on the label for each of the span elements
        labels.forEach((label) => {
            label.querySelectorAll("span").forEach((span) => {
                const backgroundStyle = span.innerText;

                label.setAttribute("style", `background: ${backgroundStyle};`);
                span.innerText = "";
            });
        });
    };

    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.addedNodes && mutation.addedNodes.length > 0) {
                mutation.addedNodes.forEach(function (node) {
                    if (typeof node.querySelectorAll !== "function") {
                        return;
                    }

                    const palettes = node.querySelectorAll(".colorpalette");

                    palettes.forEach((palette) => {
                        ColorPaletteField(palette);
                    });
                });
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });
})();
