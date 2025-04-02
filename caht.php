<?php
include "dev/style/head.php";
// print_r($_SESSION);
if(!isset($_SESSION["login"])){
  header("location:register.php");
 
  // exit;
}
?>
    <body>
        <section id="chat">
          <div class="container d-flex justify-content-between">
            <div class="left-sec">
              <div class="d-flex justify-content-between align-items-center title">
                <img src="assets/images/Group 10 (2) 2.png" alt="">
                <h4 class="me-5">My Chats</h4>
                <i class="fas fa-sliders-h"></i>
              </div>
              <div class="enter">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores officia possimus enim perspiciatis, nemo blanditiis vero. Dolorum voluptatem, culpa fuggggga a dolor tempore omnis facilis distinctio quos vel architecto impedit.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores officia possimus enim perspiciatis, nemo blanditiis vero. Dolorum voluptatem, culpa fuggggga a dolor tempore omnis facilis distinctio quos vel architecto impedit.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores officia possimus enim perspiciatis, nemo blanditiis vero. Dolorum voluptatem, culpa fuggggga a dolor tempore omnis facilis distinctio quos vel architecto impedit.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores officia possimus enim perspiciatis, nemo blanditiis vero. Dolorum voluptatem, culpa fuggggga a dolor tempore omnis facilis distinctio quos vel architecto impedit.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores officia possimus enim perspiciatis, nemo blanditiis vero. Dolorum voluptatem, culpa fuggggga a dolor tempore omnis facilis distinctio quos vel architecto impedit.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores officia possimus enim perspiciatis, nemo blanditiis vero. Dolorum voluptatem, culpa fuggggga a dolor tempore omnis facilis distinctio quos vel architecto impedit.
              </div>
            </div>
            <div class="right-sec">
              <div class="enter">
                <h3 class="text-center">How can i help you today?</h3>
                <p class=" text-center text-muted">If you are healthy. you are probably happy. If are healthy and happy.
                  you have all the wealth you need. even if it is not everything you want.
                  Health is many blessings us, which enables a person to live a normal life.
                  and enables him to enjoy his life.</p>
                  <div class="d-flex justify-content-around">
                    <div class="iconic">
                      <i class="fa-solid fa-stethoscope"></i><span class="d-block mt-3">Medical</span>
                      Type
                    </div>
                    <div class="iconic">
                      <i class="fa-solid fa-language"></i><span class="d-block mt-3">Multilingual</span>
                        Support</span>
                    </div>
                  </div>
              </div>
              <div class="feel">
                <input type="text" placeholder="How can i help you today?">
                <button>Send</button>
              </div>
            </div>
          </div>
        </section>
    </body>

  </html>