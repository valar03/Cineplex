<?php include('header.php'); ?>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

.about-us{
  height: 100vh;
  width: 100%;
  padding: 90px 0;
  background: #ddd;
}
.pic{
  height: auto;
  width:  500px;
}
.about{
  width: 1130px;
  max-width: 85%;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-around;
}
.text{
  width: 540px;
}
.text h2{
  font-size: 90px;
  font-weight: 600;
  margin-bottom: 10px;

}
.text h5{
  font-size: 22px;
  font-weight: 500;
  margin-bottom: 20px;
}
span{
  color: #4070f4;
}
.text p{
  font-size: 18px;
  line-height: 25px;
  letter-spacing: 1px;
}
.data{
  margin-top: 30px;
}
.hire{
  font-size: 18px;
  background: #4070f4;
  color: #fff;
  text-decoration: none;
  border: none;
  padding: 8px 25px;
  border-radius: 6px;
  transition: 0.5s;
}
.hire:hover{
  background: #000;
  border: 1px solid #4070f4;
}
        </style>
  <section class="about-us">
    <div class="about">
     <img src="img1.jfif" class="pic" width="1000px" height="500px">
      <div class="text">
        <h1>About Us</h1>
        <p align="justify">&nbsp;&nbsp;&nbsp;Welcome to our website! We are passionate about bringing the magic of cinema to your fingertips, making it easy and convenient for you to enjoy the latest movies at your favorite  theater. At our website, we strive to provide you with a seamless and hassle-free  ticket booking experience.</p> 

<p align="justify">&nbsp;&nbsp;&nbsp;Our team is dedicated to curating a wide selection of movies, catering to diverse tastes and genres. From action-packed blockbusters and heartwarming dramas to side-splitting comedies and gripping thrillers, there's something for everyone. </p> 

 <p align="justify">&nbsp;&nbsp;Our website also provides reviews and ratings , giving you valuable insights and recommendations. Also, we offer secure and reliable payment options to ensure your transactions are safe and convenient.Thank you for choosing our website.</p> 

        <div class="data">
        
        </div>
      </div>
    </div>
  </section>
</body>

<?php include('footer.php') ?>