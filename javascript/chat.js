const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
ticket_id = form.querySelector(".ticket_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/insert-chat", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    setTimeout(function() {
        chatBox.classList.remove("active");
    }, 3000);
}

let first = true;
var chatboxChildNum = 0;
var limit = 8

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/get-chat?", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(first){
                first = false;
                scrollToBottom();
            }else if((chatBox.scrollHeight + (chatBox.scrollTop - chatBox.clientHeight)) < 100){
                limit += 3;
                chatboxChildNum = chatBox.childElementCount;
            }else{
                if((chatBox.childElementCount > chatboxChildNum)&& ((chatBox.scrollHeight + (chatBox.scrollTop - chatBox.clientHeight)) < 2000)){
                    chatboxChildNum = chatBox.childElementCount;
                    scrollToBottom();
                }
            }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id+"ticket_id"+ticket_id+"&"+"limit="+ limit);
}, 500);

function scrollToBottom(){
    chatBox.scrollTo({
    top: chatBox.scrollHeight,
    behavior: 'smooth',
  });
}