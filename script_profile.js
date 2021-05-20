// Creating Trigger Click Function 

function triggerClick() {

    document.querySelector('#profile_image').click();
}

function imageDisplay(e) {

    if (e.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

            document.querySelector('#profile_image').setAttribute('src',e.target.result);

        }

        reader.readAsDataURL(e.files[0]);
    }
}