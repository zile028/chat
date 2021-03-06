let profil = document.getElementById("profil");
let fileImg = document.getElementById("file-img");

if (fileImg) {
  fileImg.addEventListener("change", showPicture);
}

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

// trash button
let trashBtn = document.querySelectorAll(".trash-btn");

trashBtn.forEach((btn) => {
  btn.addEventListener("click", httpRequest);
});

function httpRequest() {
  let xml = new XMLHttpRequest();
  let url = "http://localhost:8888/chat/delete_message.php";
  let el = this;
  let data = "id=" + this.getAttribute("data-msgid");
  xml.open("POST", url);
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.onreadystatechange = function () {
    if (xml.readyState === 4 && xml.status === 200) {
      result = JSON.parse(xml.response);
      trash(el, result);
    }
  };

  xml.send(data);
}

function trash(el, result) {
  let msgWraper = el.closest(".card");
  let msgBox = document.querySelectorAll("[data-mailbox]");
  msgBox.forEach((box) => {
    box.innerHTML = result[box.getAttribute("data-mailbox")];
  });
  msgWraper.remove();
}
