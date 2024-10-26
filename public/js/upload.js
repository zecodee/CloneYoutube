// vidio priview #
const wrapper = document.querySelector(".wrapper");
const fileName = document.querySelector(".file-name");
const defaultBtn = document.querySelector("#video");
const customBtn = document.querySelector("#custom-btn");
const cancelBtn = document.querySelector("#cancel-btn i");
const video = document.querySelector("#preview-video");
const image = document.querySelector("#preview-image");
let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

// image priview ##
const imagePreview = document.querySelector("#image-preview");
const uploadImageBtn = document.querySelector("#thumbnail");

// vidio priview #
function defaultBtnActive(){
  defaultBtn.click();
}

defaultBtn.addEventListener("change", function(){
  const file = this.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = function(){
      const result = reader.result;
      if (file.type.includes('video')) {
        video.src = result;
        video.style.display = "block";
        image.style.display = "none";
      } else {
        image.src = result;
        image.style.display = "block";
        video.style.display = "none";
      }
      wrapper.classList.add("active");
    }
    cancelBtn.addEventListener("click", function(){
      video.src = "";
      image.src = "";
      wrapper.classList.remove("active");
      fileName.textContent = "";
      video.style.display = "none";
      image.style.display = "none";
    })
    reader.readAsDataURL(file);
    fileName.textContent = file.name;
  }
});

// image priview ##
uploadImageBtn.addEventListener("change", function(){
  const file = this.files[0];
  if(file){
      const reader = new FileReader();
      reader.onload = function(){
          const result = reader.result;
          imagePreview.src = result;
      }
      reader.readAsDataURL(file);
  } else {
      imagePreview.src = "{{ asset('images/null.png') }}";
  }
});
