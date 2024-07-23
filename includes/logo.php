<div class="logo">
            <img src="image/logo.png" alt="logo">
        </div>

      

        <div class="reseau">
            <a href="page_instagram">
            <img src="image/instagram.png" alt="instagram">
            </a> 
            <a href="page_facebook">
            <img src="image/facebook.png" alt="facebook">
            </a>
            <a href="page_twitter">
            <img src="image/twitter.png" alt="twitter">
            </a>

        </div>

        <style>
            .logo {
    display: flex;
    justify-content: center;
    align-items: center;
}

.coordonnées {
    display: flex;
    justify-content: space-around; 
    color: rgb(158, 138, 26); 
    margin-bottom: 30px;
}

.coordonnées a {
    color: rgb(158, 138, 26); 
    text-decoration: none;
}

.coordonnées p {
    margin: 0%;
}

.reseau {
    display: flex;
    justify-content: center; 
}

.reseau img {
    height: 60px; 
}

@media only screen and (max-width: 600px) {
        .coordonnées p,
        .coordonnées a {
            font-size: 12px; 
        }

        .reseau img {
            height: 30px; 
        }
    }

        </style>