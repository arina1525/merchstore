<?= view('layouts/header') ?>

<div class="container py-4">

    <a
        href="/products/detail/<?= $product['id'] ?>"
        class="btn btn-outline-secondary mb-4">

        <i class="bi bi-arrow-left"></i>
        Back

    </a>


    <div class="row g-4">


        <div class="custom-card">

            <h3>
                <?= $product['name'] ?>
            </h3>

            <h4 class="price-purple">

                Rp <?= number_format(
                        $product['price']
                    ) ?>

            </h4>

        </div>

        <div class="col-lg-6">

            <div class="custom-card">

                <h4>
                    Upload Design
                </h4>

                <input
                    type="file"
                    class="form-control"
                    id="designFile">

            </div>

        </div>
        <div class="col-lg-6">
            <div class="custom-card" id="svgUploadBox">

                <h4>
                    Upload Silhouette
                </h4>

                <input
                    type="file"
                    class="form-control"
                    id="cutlineFile"
                    accept=".svg">

            </div>
        </div>

    </div>
    <div class="preview-wrapper">

        <div id="previewCanvas"></div>
        <input type="hidden"
            id="previewImage"
            name="preview_image">

    </div>
    <div class="custom-card mt-4">

        <?php foreach ($groups as $group): ?>

            <h5 class="mt-3">
                <?= $group['name'] ?>
            </h5>

            <?php foreach (
                $group['variants']
                as $variant
            ): ?>

                <div class="form-check">

                    <input
                        type="radio"
                        class="form-check-input variant-option"
                        name="group_<?= $group['id'] ?>"
                        value="<?= $variant['id'] ?>"
                        data-price="<?= $variant['additional_price'] ?>"
                        data-name="<?= strtolower($variant['name']) ?>">

                    <label
                        class="form-check-label">

                        <?= $variant['name'] ?>

                        (+Rp <?= number_format(
                                    $variant['additional_price']
                                ) ?>)

                    </label>

                </div>
                <input
                    type="hidden"
                    id="holeX"
                    name="hole_x"
                    value="250">

                <input
                    type="hidden"
                    id="holeY"
                    name="hole_y"
                    value="80">

            <?php endforeach ?>

        <?php endforeach ?>

    </div>
    <div class="custom-card mt-4">

        <label>
            Quantity
        </label>

        <input
            type="number"
            id="qty"
            class="form-control"
            min="1"
            value="1">

    </div>
    <div class="custom-card mt-4">

        <h4>

            Total :

            <span id="totalPrice">

                Rp <?= number_format(
                        $product['price']
                    ) ?>

            </span>

        </h4>

    </div>
    <div class="text-center mt-5">
        <?php if (session()->get('user_id')): ?>
            <form id="cartForm">
                <button
                    class="btn btn-purple btn-lg"
                    id="addToCartBtn">

                    Add To Cart

                </button>

            <?php else: ?>

                <a
                    href="/login"
                    class="btn btn-purple btn-lg">

                    Login to Order

                </a>
            </form>

        <?php endif ?>

    </div>

    <script>
        document
            .getElementById('addToCartBtn')
            .addEventListener('click', async function() {

                const previewImage =
                    stage.toDataURL({
                        pixelRatio: 2
                    });

                document.getElementById(
                    'previewImage'
                ).value = previewImage;

                const variants = [];

                document
                    .querySelectorAll(
                        '.variant-option:checked'
                    )
                    .forEach(item => {

                        variants.push(
                            item.value
                        );

                    });

                const formData =
                    new FormData();

                formData.append(
                    'product_id',
                    <?= $product['id'] ?>
                );

                formData.append(
                    'qty',
                    document.getElementById('qty').value
                );

                formData.append(
                    'hole_x',
                    document.getElementById('holeX').value
                );

                formData.append(
                    'hole_y',
                    document.getElementById('holeY').value
                );

                formData.append(
                    'preview_image',
                    previewImage
                );

                formData.append(
                    'design_file',
                    document.getElementById('designFile')
                    .files[0]
                );

                if (
                    document.getElementById('cutlineFile')
                    .files[0]
                ) {

                    formData.append(
                        'svg_file',
                        document.getElementById(
                            'cutlineFile'
                        ).files[0]
                    );

                }

                formData.append(
                    'variants',
                    JSON.stringify(
                        variants
                    )
                );

                const response =
                    await fetch(
                        '/cart/add', {
                            method: 'POST',
                            body: formData
                        }
                    );

                const result =
                    await response.json();

                alert(result.message);

            });
        const designFile =
            document
            .getElementById('designFile')
            .files[0];
        const cutlineFile =
            document
            .getElementById('cutlineFile')
            .files[0];
        const productCategory = "<?= $product['preview_type'] ?>";
        if (
            productCategory !== 'keychain' &&
            productCategory !== 'phonestrap' &&
            productCategory !== 'sticker' &&
            productCategory !== 'standee'
        ) {
            document
                .getElementById('svgUploadBox')
                .style.display = 'none';
        }
        const basePrice =
            <?= $product['price'] ?>;

        function calculateTotal() {
            let additional = 0;

            document
                .querySelectorAll(
                    '.variant-option:checked'
                )
                .forEach(item => {

                    additional +=
                        parseInt(
                            item.dataset.price
                        );

                });

            let qty =
                parseInt(
                    document
                    .getElementById('qty')
                    .value
                );

            let total =
                (basePrice + additional) *
                qty;

            document
                .getElementById('totalPrice')
                .innerText =
                'Rp ' +
                total.toLocaleString();
        }

        document
            .querySelectorAll(
                '.variant-option'
            )
            .forEach(item => {

                item.addEventListener(
                    'change',
                    function() {

                        calculateTotal();

                        drawBleed();
                        drawHole();
                        drawStandeeBase();
                        drawPaperGuide();
                        drawPinGuide();

                    }
                );

            });

        document
            .getElementById('qty')
            .addEventListener(
                'input',
                calculateTotal
            );
        let safeArea = null;
        let standeeSlot = null;
        let standeeBase = null;
        let bleedOutline = null;
        let bleedPath = null;
        let svgData = null;
        let cutlinePath = null;
        let cutline = null;
        let uploadedImage = null;
        let holeGroup = null;
        let holeX = 250;
        let holeY = 80;
        let bleedShape = null;
        const previewWidth =
            Math.min(
                window.innerWidth - 40,
                600
            );

        const stage =
            new Konva.Stage({

                container: 'previewCanvas',

                width: previewWidth,

                height: previewWidth + 100

            });

        const layer = new Konva.Layer();
        const canvasSize =
            stage.width();

        const previewSize =
            canvasSize * 0.8;

        const previewOffset =
            (canvasSize - previewSize) / 2;

        stage.add(layer);
        document
            .getElementById('designFile')
            .addEventListener('change', function(e) {

                const file = e.target.files[0];

                if (!file) return;

                const reader = new FileReader();

                reader.onload = function(event) {

                    const img = new Image();

                    img.onload = function() {

                        if (uploadedImage) {
                            uploadedImage.destroy();
                        }

                        uploadedImage =
                            new Konva.Image({

                                x: previewOffset,
                                y: previewOffset,

                                image: img,

                                width: previewSize,
                                height: previewSize,
                                draggable: productCategory === 'print' ||
                                    productCategory === 'pin'

                            });

                        layer.add(uploadedImage);
                        drawBleed();
                        drawHole();

                        layer.draw();
                    };

                    img.src = event.target.result;
                };

                reader.readAsDataURL(file);

            });
        stage.on('wheel', function(e) {

            if (
                productCategory !== 'print' &&
                productCategory !== 'pin'
            ) {
                return;
            }

            if (!uploadedImage)
                return;

            e.evt.preventDefault();

            const oldScale =
                uploadedImage.scaleX();

            const scaleBy = 1.05;

            const newScale =
                e.evt.deltaY > 0 ?
                oldScale / scaleBy :
                oldScale * scaleBy;

            uploadedImage.scale({
                x: newScale,
                y: newScale
            });

            layer.draw();
            uploadedImage.moveToBottom();
        });
        document
            .getElementById('cutlineFile')
            .addEventListener('change', function(e) {

                const file = e.target.files[0];

                if (!file) return;

                const reader = new FileReader();

                reader.onload = function(event) {

                    const svgText =
                        event.target.result;

                    const parser =
                        new DOMParser();

                    const svgDoc =
                        parser.parseFromString(
                            svgText,
                            'image/svg+xml'
                        );

                    const pathElement =
                        svgDoc.querySelector('path');

                    if (!pathElement) {
                        alert('Path tidak ditemukan');
                        return;
                    }

                    const pathData =
                        pathElement.getAttribute('d');
                    svgData = pathData;

                    if (cutlinePath) {
                        cutlinePath.destroy();
                    }

                    cutlinePath =
                        new Konva.Path({

                            data: pathData,

                            stroke: '#52307c',

                            strokeWidth: 50,

                            fillEnabled: false

                        });

                    cutlinePath.scale({

                        x: previewSize / 5000,
                        y: previewSize / 5000

                    });

                    cutlinePath.position({

                        x: previewOffset,
                        y: previewOffset

                    });

                    layer.add(cutlinePath);
                    const box =
                        cutlinePath.getClientRect();

                    holeX =
                        box.x + (box.width / 2);

                    holeY =
                        box.y + 30;
                    drawBleed();

                    drawHole();

                    layer.draw();

                };

                reader.readAsText(file);

            });

        function drawHole() {
            if (
                productCategory !== 'keychain' &&
                productCategory !== 'phonestrap'
            ) {
                return;
            }
            if (!uploadedImage)
                return;

            if (holeGroup)
                holeGroup.destroy();

            holeGroup = new Konva.Group({

                x: holeX,
                y: holeY,

                draggable: true


            });

            const outerRing =
                new Konva.Circle({

                    x: 0,
                    y: 0,

                    radius: 20,

                    stroke: '#52307c',
                    strokeWidth: 4

                });

            const innerHole =
                new Konva.Circle({

                    x: 0,
                    y: 0,

                    radius: 12,

                    stroke: '#52307c',
                    strokeWidth: 4

                });

            holeGroup.add(outerRing);
            holeGroup.add(innerHole);

            holeGroup.on('dragmove', function() {

                holeX = holeGroup.x();
                holeY = holeGroup.y();

                document.getElementById('holeX').value =
                    Math.round(holeX);

                document.getElementById('holeY').value =
                    Math.round(holeY);

            });

            layer.add(holeGroup);

            holeGroup.moveToTop();

            layer.draw();
        }

        function drawBleed() {
            if (!svgData)
                return;

            if (bleedPath)
                bleedPath.destroy();
            if (bleedOutline)
                bleedOutline.destroy();

            let isBleed = false;

            document
                .querySelectorAll('.variant-option:checked')
                .forEach(item => {

                    const name =
                        item.dataset.name;

                    if (
                        name === 'with bleed' ||
                        name === 'bleed'
                    ) {
                        isBleed = true;
                    }

                });

            if (!isBleed) {
                if (cutlinePath)
                    cutlinePath.visible(true);
                cutlinePath.moveToTop();
                standeeSlot.moveToBottom();

                layer.draw();
                return;
            }


            bleedPath =
                new Konva.Path({

                    data: svgData,

                    stroke: 'white',

                    strokeWidth: 300,

                    fillEnabled: true

                });

            bleedOutline =
                new Konva.Path({

                    data: svgData,

                    stroke: '#52307c',

                    strokeWidth: 400,

                    fillEnabled: false

                });

            bleedPath.scale({

                x: (previewSize / 5000),
                y: (previewSize / 5000)

            });

            bleedPath.position({

                x: previewOffset,
                y: previewOffset

            });
            bleedOutline.scale({

                x: (previewSize / 5000),
                y: (previewSize / 5000)

            });

            bleedOutline.position({

                x: previewOffset,
                y: previewOffset

            });

            layer.add(bleedPath);
            layer.add(bleedOutline);

            bleedPath.moveToBottom();

            if (uploadedImage)
                uploadedImage.moveToTop();
            cutlinePath.moveToBottom();

            bleedOutline.moveToBottom();

        }

        function drawStandeeBase() {
            if (
                productCategory !== 'standee'
            ) {
                return;
            }

            if (standeeBase)
                standeeBase.destroy();

            standeeBase =
                new Konva.Rect({

                    x: stage.width() / 2 - 120,

                    y: stage.height() - 110,

                    width: 240,

                    height: 65,

                    stroke: '#52307c',

                    strokeWidth: 5,

                });

            const standeeSlot =
                new Konva.Rect({

                    x: stage.width() / 2 - 35,

                    y: stage.height() - 185,

                    width: 70,

                    height: 50,

                    stroke: '#52307c',

                    strokeWidth: 5

                });

            layer.add(
                standeeBase,
            );
            layer.add(
                standeeSlot
            );
            standeeSlot.moveToBottom();
            standeeBase.moveToBottom();
            bleedOutline.moveToTop();
            bleedPath.moveToTop();

            if (uploadedImage)
                uploadedImage.moveToTop();
            cutlinePath.moveToBottom();
        }
        window.onload = function() {
            initPreview();
        };

        function initPreview() {

            switch (productCategory) {

                case 'print':
                    drawPrintGuide();
                    break;

                case 'pin':
                    drawPinGuide();
                    break;

                case 'standee':
                    drawStandeeGuide();
                    break;

                case 'keychain':
                case 'phonestrap':
                case 'sticker':
                    // menunggu upload SVG
                    break;
            }

            layer.draw();
        }

        function drawPrintGuide() {

            const w = previewSize * 0.7;
            const h = w * 1.414;

            const x = (stage.width() - w) / 2;
            const y = (stage.height() - h) / 2;

            const paper = new Konva.Rect({
                x: x,
                y: y,
                width: w,
                height: h,
                stroke: '#52307c',
                strokeWidth: 3
            });

            layer.add(paper);

            paper.moveToTop();
        }

        function drawPinGuide() {

            const centerX = stage.width() / 2;
            const centerY = stage.height() / 2;

            const outerCircle =
                new Konva.Circle({

                    x: centerX,
                    y: centerY,

                    radius: 170,

                    stroke: '#52307c',
                    strokeWidth: 4

                });

            const safeArea =
                new Konva.Circle({

                    x: centerX,
                    y: centerY,

                    radius: 140,

                    stroke: 'red',

                    dash: [10, 5]
                });

            layer.add(outerCircle);
            layer.add(safeArea);
            outerCircle.moveToTop();
            safeArea.moveToTop();
            uploadedImage.moveToBottom();
        }
    </script>
    <?= view('layouts/footer') ?>