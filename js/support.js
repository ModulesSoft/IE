
/**
 * Created by Yousef on 18/05/15.
 */
picture="";
function openChat() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            if(obj.success == true){
                document.getElementById("support-closed").style.display="none";
                document.getElementById("support-open").style.display="block";
                getSupport();
            }else {
                alert("can't connect");
            }
        }
    };
    xhttp.open("GET", "http://51.15.59.130:46260/start", true);
    xhttp.send();
    // getResponse();
}
function closeChat() {
    document.getElementById("support-closed").style.display="block";
    document.getElementById("support-open").style.display="none";
}
function send() {
    var text = document.getElementById('text').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var message = document.createElement("div");
            message.setAttribute("class","message");
            var messagetext = document.createElement("div");
            messagetext.setAttribute("class","message-text");
            var p = document.createElement("p");
            p.innerHTML=text;
            var img = document.createElement("img");
            img.setAttribute("class","message-image");
            img.src="style/img/me.jpg";

            messagetext.appendChild(p);
            message.appendChild(messagetext);
            message.appendChild(img);

            document.getElementById('messages').appendChild(message);
            document.getElementById('text').value="";
        }
    };
    xhttp.open("POST", "http://51.15.59.130:46260/send", true);
    obj = '{"message":"'+text+'"}';
    xhttp.send(obj);


}
function getSupport() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            document.getElementById('support-name').innerHTML=obj.support.first+" "+obj.support.last;
            document.getElementById('support-image').src=obj.support.picture;
            picture=obj.support.picture;
        }
    };
    xhttp.open("GET", "http://51.15.59.130:46260/support", true);
    xhttp.send();
    setInterval(getResponse, 3000);
}
function getResponse() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            var message = document.createElement("div");
            message.setAttribute("class","response");
            var messagetext = document.createElement("div");
            messagetext.setAttribute("class","message-text");
            var p = document.createElement("p");
            p.innerHTML=obj.responses[0]['message'];
            var img = document.createElement("img");
            img.setAttribute("class","message-image");
            img.src=picture;

            messagetext.appendChild(p);
            message.appendChild(img);
            message.appendChild(messagetext);

            document.getElementById('messages').appendChild(message);
            document.getElementById('text').value="";
        }
    };
    xhttp.open("GET", "http://51.15.59.130:46260/fetch", true);
    xhttp.send();
}