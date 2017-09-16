var canvas = new fabric.Canvas('c', {
    preserveObjectStacking: true
});

canvas.setZoom(1);

var opacity = 0;

//Allows us to position menu icons ontop of the canvas
fabric.Canvas.prototype.getAbsoluteCoords = function(object) {
   return {
     left: 500,
     top: 150
   };
 }

//Load image to canvas when upload button is pressed
document.getElementById('uploadBtn').onchange = function handleImage(e) {
    canvas.clear();
    var reader = new FileReader();
    reader.onload = function (event) {
        var imgObj = new Image();
        imgObj.src = event.target.result;
        imgObj.onload = function () {

            var image = new fabric.Image(imgObj);
            image.set({
                left: 0,
                top: 0,
                width: 600,
                // height: 600,
                angle: 0,
                padding: 0,
                cornersize: 10
                // selectable: false
            });

            canvas.add(image);
            canvas.sendToBack(image);
            //image.scale(getRandomNum(0.1, 0.25)).setCoords();
        }
    }
    reader.readAsDataURL(e.target.files[0]);
}

//Applys tint to the given target, at the given opacity
function applyTint(opa){
    this.opacity = opa;
    //Create the black filter of given opacity
    var tintFilter = new fabric.Image.filters.Tint({
        color: 'black',
        opacity: opa
    });

    var target =  canvas.item(0);

    //Clear any existing tints and apply the new one
    target.filters.length = 0;
    target.filters.push(tintFilter);
    target.applyFilters(canvas.renderAll.bind(canvas));
    canvas.renderAll();
}


//Allows adding text boxes to the image
function addTextBox() {
    var textOptions = {
        left: 150,
        top: 200,
        fontSize: 20,
        fontFamily: 'Arial',
        fontWeight: 'bold'
    };

    var textBox = new fabric.IText("Enter text...", textOptions);
    canvas.add(textBox).setActiveObject(textBox);
    canvas.renderAll();
}

//Adds click functionality to the text box icon
$(document).on("click", '.addBtn', function() {
    console.log("clicked");
    addTextBox();
});


//Changes text color to white
$(document).on("click", ".whiteBtn", function() {
    var objs = getTextBoxes();

    for(var i = 0; i < objs.length; i++){
        objs[i].setColor('white');
        console.log("completed");
    }

    canvas.renderAll();
})

//Changes text color to black
$(document).on("click", ".blackBtn", function() {
    var objs = getTextBoxes();

    for(var i = 0; i < objs.length; i++){
        objs[i].setColor('black');
        console.log("completed");
    }

    canvas.renderAll();
})

//Returns all text boxes on the canvas
function getTextBoxes(){
    var objs = canvas.getObjects().filter(function(o) {
        if (o.get('type') === 'i-text') {
            return o.set('active', true);
        }
    });
    return objs;
}


//Server side saving of canvas images



//Hovering over canvas adds the menu and then removes it on mouse out
$('.container-center').mouseenter(function(e) {
    // if(canvas.getObjects().length > 0) {
        var absCoords = canvas.getAbsoluteCoords(canvas);//Places menu icons

        var background = '<img src="images/creatorMenuBackground1.png" class="creatorMenu" style="opacity:0.5;position:absolute;top:'+130+'px;left:'+18.5+'%;width:62.8%;height:9%;"/>';
        $(".container-center").append(background);

        var downloadBtn = '<img src="images/downloadIcon.png" class="downloadBtn hvr-grow" style="position:absolute;top:'+150+'px;left:'+150+'px;cursor:pointer;width:30px;height:30px;"/>';
        $(".container-center").append(downloadBtn);

        var addBtn = '<img src="images/addTextBox.png" class="addBtn hvr-grow" style="position:absolute;top:'+150+'px;left:'+420+'px;cursor:pointer;width:30px;height:30px;"/>';
        $(".container-center").append(addBtn);

        var fontBtn = '<img src="images/font.png" class="fontBtn hvr-grow" style="position:absolute;top:150px;left:470px;cursor:pointer;width:30px;height:30px;"/>';
        $(".container-center").append(fontBtn);

        var backgroundBtn = '<img src="images/back.png" class="backgroundBtn hvr-grow" style="position:absolute;top:'+150+'px;left:'+520+'px;cursor:pointer;width:30px;height:30px;"/>';
        $(".container-center").append(backgroundBtn);
    // }

});

//Handles activation of font "drop down"
$(document).on("click", ".fontBtn", function() {
    $(".container-center").append('<img src="images/verticalMenuBackground.png" class="creatorMenu" style="opacity:0.5;position:absolute;top:'+193.495+'px;left:'+461+'px;width:50px;height:100px;"/>');
    $(".container-center").append('<img src="images/blackIcon.png" class="blackBtn" style="position:absolute;top:'+200+'px;left:'+471+'px;cursor:pointer;width:30px;height:30px;"/>');
    $(".container-center").append('<img src="images/whiteIcon.png" class="whiteBtn" style="position:absolute;top:'+250+'px;left:'+471+'px;cursor:pointer;width:30px;height:30px;"/>');
});

//Handles activation of background "drop down"
$(document).on("click", ".backgroundBtn", function(){
    $(".container-center").append('<img src="images/verticalMenuBackground.png" class="creatorMenu" style="opacity:0.5;position:absolute;top:'+193.495+'px;left:'+510+'px;width:50px;height:100px;"/>');
    $(".container-center").append('<input class="opacity-slider" style="opacity:0.5;position:absolute;top:'+200+'px;left:'+510+'px;width:50px;height:80px;" orient="vertical" onchange="applyTint(this.value)" type="range" max="1" min="0" step="0.1" value="this.opacity"></input>');
});

//Handles the user downloading of the image
$(document).on("click", ".downloadBtn", function() {
    //Deactivates all bounding boxes so they dont show up in exported image
    canvas.deactivateAll();
    canvas.renderAll();
    $("#c").get(0).toBlob(function(blob) {
        saveAs(blob, "img.png");
    });
});

//Fades out all menu elements
$('.container-center').mouseleave(function(e) {
    $(".creatorMenu").fadeOut();
    $(".addBtn").fadeOut();
    $(".fontBtn").fadeOut();
    $(".backgroundBtn").fadeOut();
    $(".blackBtn").fadeOut();
    $(".whiteBtn").fadeOut();
    $(".opacity-slider").fadeOut();
    $(".downloadBtn").fadeOut();
});
