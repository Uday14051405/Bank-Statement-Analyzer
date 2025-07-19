<style>

/* Profile Image css  */
.profile {
display: flex;
align-items: center;
position: relative;
margin-left: 15px;
}

.profile-img {
width: 30px;
height: 30px;
border-radius: 50%;
margin-right: 10px;
}

.profile-name {
font-size: 14px;
font-weight: bold;
cursor: pointer;
}

.dropdown14 {
position: relative;
}

.dropdown-btn14 {
background-color: transparent;
border: none;
font-size: 16px;
cursor: pointer;
color: #000;
margin-left: 5px;
}

.dropdown-content14 {
display: none;
position: absolute;
right: 0;
background-color: #fff;
box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
z-index: 1;
width: 120px;
}

.dropdown-content14 a {
color: black;
padding: 10px;
text-decoration: none;
display: block;
}

.dropdown-content14 a:hover {
background-color: #f1f1f1;
color: black;
padding: 10px;
text-decoration: none;
display: block;
}

.profile:hover .dropdown-content14 {
display: block;
}


#header {
background-color: white;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
padding: 10px 20px;
width: 100%;
z-index: 1000;
top: 0;
position: fixed;
}

#header .logo img {
max-height: 50px;
}


.header-container {
display: flex;
justify-content: space-between;
align-items: center;
max-width: 1200px;
margin: 0 auto;
}



#header .getstarted20 {
background-color: #ed217c;
/* background: linear-gradient(to bottom right, #27cafd, #028ad7); */
color: #fff;
padding: 10px 20px;
border-radius: 4px;
text-decoration: none;
font-size: 14px;
font-weight: 700;
display: inline-block;
/* margin-left: 15px; */
transition: background-color 0.3s ease;
}

@media (max-width: 768px) {
.header-container{
/* flex-direction: column; */
align-items: center;
/* text-align: center; */
}

/* #left20, */
#right20 {
width: 100%;
justify-content: end;
/* margin-bottom: 10px; */
}

/* #header .logo img {
margin-bottom: 10px;
} */

/* #header .getstarted20 {
width: 100%;
text-align: center;
display: inline-block;
} */
}
.dynamic p {
        color: #000;
        background-color: #f4f4f4;
        font-size: 1.6em;
        padding: 0.4em 0em;
    }
</STYLE>
<header id="header" class="fixed-top">
    <div class="container header-container d-flex justify-content-between align-items-center">
        <div class="logo me-auto">
            <a href="{{ url('/') }}">
            <img src="{{ asset('assets_front/img/Items.png') }}" alt="Logo">
            </a>
        </div>

    <div class="d-flex" id="right20">
        <a class="getstarted20" href="contact.php">Talk to sales</a>
        <div class="profile">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQA3W3oppN7sdVCsUWwwnPIn9pX6E6G2UW70w&s" alt="Profile" class="profile-img">
            <span class="profile-name">{{ Auth::user()->name}}</span>
            <div class="dropdown14">
                <button class="dropdown-btn14">▼</button>
                <div class="dropdown-content14">
                    <!-- <a href="{{ route('customer_profile') }}">Profile</a> -->
                    <a href="{{ route('customer_logout') }}">Log out</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    
</header>
<div class="bankstatement">
<div class="dynamic">
        <center>
            <p> Name: {{ Auth::user()->name}} &nbsp;&nbsp;&nbsp; Mobile No: +91 {{ Auth::user()->mobile}}</p>
        </center>
    </div>