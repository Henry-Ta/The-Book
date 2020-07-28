//idea is creating a div in html for preview image only 
//then reading value from selecting image in javascript before submitting
//and making <img ... src> in javascript to assign into <div> to display preview image
$(document).ready(function(){
    var name_image = '';

    //create image element
    var img = document.createElement("img");
    // get location of div
    var src = document.getElementById("showImg");
    
    $("input").change(function(){       // select value of input once it changed
        name_image = this.files[0].name;

        document.getElementById("showImg").innerHTML = "Preview Image <br><br>";
        img.src = "../images/"+name_image;      //assign value
        src.appendChild(img);
    });

});
   
