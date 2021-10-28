let profil = document.getElementById("profil");
let fileImg = document.getElementById("file_img");

fileImg.addEventListener("change", showPicture);

function showPicture() {
  let file = this.files[0];
  let reader = new FileReader();

  reader.readAsDataURL(file);
  let fileName = file.name;
  let extension = fileName.split(".").pop();
  let allowExt = ["jpg", "jpeg", "png", "bmp"];
  reader.onload = function () {
    if (allowExt.indexOf(extension) == 0) {
      profil.setAttribute("src", reader.result);
    } else {
      fileImg.value = "";
      profil.setAttribute("src", "");
    }
  };
}
