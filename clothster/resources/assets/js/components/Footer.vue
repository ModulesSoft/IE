<template>
    <div class="footer">
        <div class="footer-container" align="center">
            <div class="footer-col" align="right">
                <div class="mb-3"><strong>خدمات مشتریان</strong></div>
                <p>سوالات متداول</p>
                <p>بازگرداندن کالا</p>
                <p>شرایط استفاده</p>
                <p>حریم شخصی</p>
            </div>
            <div class="footer-col">
                <div class="mb-3"><strong>اطلاعات ما</strong></div>
                <p>درباره ما</p>
                <p>تماس باما</p>
            </div>
            <div class="footer-col" >
                <div class="mb-1"><strong>به ما در رسانه های اجتماعی بپیوندید</strong></div>
                <br>
                <a href="#">
                    <div id="facebook"></div>
                </a>
                <a href="#">
                    <div id="twitter"></div>
                </a>
                <a href="#">
                    <div id="gplus"></div>
                </a>
                <br>
                <a href="#">
                    <div id="facebook"></div>
                </a>
                <a href="#">
                    <div id="twitter"></div>
                </a>
                <a href="#">
                    <div id="gplus"></div>
                </a>
            </div>
            <div class="footer-col">
                <p>
                    تمامی حقوق این سایت متعلق به دانشگاه امیرکبیر بوده و هرگونه استفاده از منابع و طراحی های این سایت
                    توسط نهادی خارج از دانشگاه با پیگرد قانونی همراه خواهد بود.
                </p>
            </div>
        </div>


        <!-- <div id="support-closed" class="support-closed">
            <a onclick="openChat();">
                <img src="~\assets\img\support-closed.png">
                <p>پشتیبانی آنلاین</p>
            </a>
        </div>

        <div id="support-open" class="support-open">
            <button onclick="closeChat();">_</button>
            <img id="support-image" class="supporter" src="">
            <div class="header">
                <h3 style="margin-bottom: -10px">پشتیبان بخش فروش</h3>
                <p id="support-name"></p>
            </div>
            <div class="chat">
                <div id="messages">
                </div>
                <div class="input">
                    <div style="background-color: #FFF;border-radius: 10px;height: inherit">
                        <input id="text" type="text" placeholder="متن پیام به پشتیبانی...">
                        <button @click>
                            <img src="~\assets\img\send.png"
                                            style="width: 25px;margin-right: -4px">
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>
<script>
export default {
  // methods: {
  //   openChat: function() {
  //     var xhttp = new XMLHttpRequest();
  //     xhttp.onreadystatechange = function() {
  //       if (this.readyState == 4 && this.status == 200) {
  //         var obj = JSON.parse(this.responseText);
  //         if (obj.success == true) {
  //           document.getElementById("support-closed").style.display = "none";
  //           document.getElementById("support-open").style.display = "block";
  //           getSupport();
  //         } else {
  //           alert("can't connect");
  //         }
  //       }
  //     };
  //     xhttp.open("GET", "http://51.15.59.130:46260/start", true);
  //     xhttp.send();
  //     // getResponse();
  //   },
  //   closeChat: function() {
  //     document.getElementById("support-closed").style.display = "block";
  //     document.getElementById("support-open").style.display = "none";
  //   },
  //   send: function() {
  //     var text = document.getElementById("text").value;
  //     var xhttp = new XMLHttpRequest();
  //     xhttp.onreadystatechange = function() {
  //       if (this.readyState == 4 && this.status == 200) {
  //         var message = document.createElement("div");
  //         message.setAttribute("class", "message");
  //         var messagetext = document.createElement("div");
  //         messagetext.setAttribute("class", "message-text");
  //         var p = document.createElement("p");
  //         p.innerHTML = text;
  //         var img = document.createElement("img");
  //         img.setAttribute("class", "message-image");
  //         img.src = "style/img/me.jpg";
  //         messagetext.appendChild(p);
  //         message.appendChild(messagetext);
  //         message.appendChild(img);
  //         document.getElementById("messages").appendChild(message);
  //         document.getElementById("text").value = "";
  //       }
  //     };
  //     xhttp.open("POST", "http://51.15.59.130:46260/send", true);
  //     obj = '{"message":"' + text + '"}';
  //     xhttp.send(obj);
  //   },
  //   getSupport: function() {
  //     var xhttp = new XMLHttpRequest();
  //     xhttp.onreadystatechange = function() {
  //       if (this.readyState == 4 && this.status == 200) {
  //         var obj = JSON.parse(this.responseText);
  //         document.getElementById("support-name").innerHTML =
  //           obj.support.first + " " + obj.support.last;
  //         document.getElementById("support-image").src = obj.support.picture;
  //         picture = obj.support.picture;
  //       }
  //     };
  //     xhttp.open("GET", "http://51.15.59.130:46260/support", true);
  //     xhttp.send();
  //     setInterval(getResponse, 3000);
  //   },
  //   getResponse: function() {
  //     var xhttp = new XMLHttpRequest();
  //     xhttp.onreadystatechange = function() {
  //       if (this.readyState == 4 && this.status == 200) {
  //         var obj = JSON.parse(this.responseText);
  //         var message = document.createElement("div");
  //         message.setAttribute("class", "response");
  //         var messagetext = document.createElement("div");
  //         messagetext.setAttribute("class", "message-text");
  //         var p = document.createElement("p");
  //         p.innerHTML = obj.responses[0]["message"];
  //         var img = document.createElement("img");
  //         img.setAttribute("class", "message-image");
  //         img.src = picture;
  //         messagetext.appendChild(p);
  //         message.appendChild(img);
  //         message.appendChild(messagetext);
  //         document.getElementById("messages").appendChild(message);
  //         document.getElementById("text").value = "";
  //       }
  //     };
  //     xhttp.open("GET", "http://51.15.59.130:46260/fetch", true);
  //     xhttp.send();
  //   }
  // }
};
</script>
<style scoped>
.footer {
  background-color: silver;
  width: 100% !important;
  /* position: absolute; */
  direction: rtl;
}
.footer-container {
  padding: 10px 150px 10px 150px;
  display: inline-flex;
}

.footer-col {
  width: 20%;
  display: inline-block;
  margin: 2%;
}

#facebook {
  background: url("../img/facebook.png");
  width: 50px;
  height: 50px;
  display: inline-block;
}

#twitter {
  background: url("../img/twitter.png");
  width: 50px;
  height: 50px;
  display: inline-block;
}

#gplus {
  background: url("../img/gplus.png");
  width: 50px;
  height: 50px;
  display: inline-block;
}

#facebook:hover {
  background: url("../img/facebook-hover.png");
}

#twitter:hover {
  background: url("../img/twitter-hover.png");
}

#gplus:hover {
  background: url("../img/gplus-hover.png");
}
</style>