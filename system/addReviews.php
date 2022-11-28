<?
 if (isset($_POST['reviewsSend'])) {
     $text = $_POST['reviewsText'];
     $text = trim($text);
     $text = htmlentities($text);
     $queryRev = $db->prepare("INSERT INTO `reviews`(`login`,`uid`,`text`) VALUES (:login,:uid,:text)");
        $queryRev-> execute ([
            ":login"=>$_SESSION['login'],
            ":uid"=>$_GET['productid'],
            ":text"=>$text
        ]);
        
    }
    

       
