<!DOCTYPE html>
<html lang="tr">
<head>
<title>Remotify</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="Style/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="Style/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="Style/icon-font.min.css">

<link rel="stylesheet" type="text/css" href="Style/animate.css">

<link rel="stylesheet" type="text/css" href="Style/hamburgers.min.css">

<link rel="stylesheet" type="text/css" href="Style/select2.min.css">

<link rel="stylesheet" type="text/css" href="Style/util.css">
<link rel="stylesheet" type="text/css" href="Style/main.css">

<script src="Js/jquery.min.js"></script>

<script src="Js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-contact100">      
    <div class="wrap-contact100">
        <div  style="align-self: start;margin:1em 0 0 2em" >
          <a href="index.php"><img src="Images/remotify-logo.png" width="170"></a> 
        </div>
        <hr>
        <div class="wrap-contact100m">
            <span class="contact100-form-title">Uygulamamı Tahmin Et</span>
            <span class="contact100-form-title-info">Aşağıdan, uygulamanızı ve ihtiyaç duyduğunuz özellikleri en iyi açıklayan öğeleri seçin.</span>
            <span class="contact100-form-title-subheading">Tüm tahminler yaklaşıktır, ancak uygulamanızı oluşturmak için neler gerekeceği konusunda size kabaca bir fikir verir.</span>
            
            <?php  

            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "remotify";

            try {$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;",$username,$password);} 
            catch (PDOException $hata) {echo $hata -> getMessage();}        

            $row1 = $db -> prepare("select * from main where id=?");
            $row2 = $db -> prepare("select * from optionname where o_id  = ?");
            $row3 = $db -> prepare("select * from optionsid where oid_id  = ?");
            $row4 = $db -> prepare("select * from info where i_id  = ?");
            $row5 = $db -> prepare("select * from value where v_id  = ?");
            $row6 = $db -> prepare("select * from optionsid where oid_id=?");
            
            $colnum=0;$counts=0;
            for ($i=0;$i<10;$i++){
             $count=0;   
             $rownum = $i+1;
             $row1 -> execute(array($rownum));
             $row2 -> execute(array($rownum));
             $row3 -> execute(array($rownum));
             $row4 -> execute(array($rownum));
             $row5 -> execute(array($rownum));
             $row6 -> execute(array($rownum));
             $process1 = $row1 ->fetch();
             $process2 = $row2 ->fetch();
             $process3 = $row3 ->fetch();
             $process4 = $row4 ->fetch();
             $process5 = $row5 ->fetch();
             $process6 = $row6 ->fetch();
             for ($k=0; $k <=10 ; $k++)  
                if ($process2[$k]) {$count++;}
             
             $colnum++;          
             $count--;
             
             $radiocheck = array("radio", "checkbox");
            
              echo '<div class="repeat-div-question" id="repeat-div-question">
                        <div class="question-title">';echo $i+1;echo' . ';echo $process1["question"]; echo ' </div>
                        <form>
                            <div class="row p-4">';
                            $sayac=0;
                            
                            for ($j=0; $j<$count; $j++) 
                                {
                                $sayac++;
                                echo'  <div class="col-xs-12 col-sm-12 col-lg-';if ($colnum <3) {echo "4";}else {echo "3";} echo'">
                                            <input class="input-hidden" type="';
                                            if ($colnum <3) {echo $radiocheck[0];}else {echo $radiocheck[1];} echo'" 
                                            value=';echo $process5[$sayac]; echo' name="value" id="';echo $process3[$sayac];echo'"  />
                                            <label class="infobox" style="position: relative;"  for="';echo $process3[$sayac];echo'">
                                                <span class="question-option" style="position: absolute;"><span class="cursor">';echo $process2[$sayac]; echo'</span></span>
                                                <img id="image-radio" src="Images/tick.png">
                                                <div class="responsive row px-3"> 
                                                    <img src="Images/';echo $process3[$sayac];echo'.png" class="cursor col-3 col-lg-12  image-m rounded-circle" 
                                                    width=100% height=100% />
                                                    <div class="hiddeninfo col-9 pl-4">
                                                    <span class="question-responsive"><span class="cursor">';echo $process2[$sayac]; echo'</span></span>';echo $process4[$sayac]; echo' 
                                                    </div>
                                                </div>  
                                                <div class="infobox-info">';echo $process4[$sayac]; echo' </div>
                                            </label>
                                        </div>';   
                                }
                    echo'</div>
                        </form>
                    </div>';
            }?>
           
           <div class="result-info">
                Toplam Maliyet : <span id="result" class="fs-65">0</span><span id="tl" class="fs-65 ml-2">₺</span>
                <p class="font-weight-light fs-12">Lütfen tüm maliyet tahminlerinin yalnızca geliştirme 
                    maliyetlerini ve zaman çizelgelerini göstermeyi 
                    amaçladığını ve tüm barındırma maliyetlerini, ücretli 
                    hizmetleri veya her türlü satın alınan varlıkları kapsamadığını unutmayın. 
                    Tüm fiyatlar TL cinsindendir ve satış vergisi dahildir.
                </p>
          </div>
           
        </div>
        <hr>

        <div style=" margin:1em 0 1em 2em">
          <a href="index.php"><img style="display: block;
            margin: auto;" src="Images/remotify-logo.png" width="170"></a> 
        </div>
    </div> 
            
    
</div>

</body>
<script type="text/javascript">

  $(document).ready(function(e){
    $("input").change(function(){
      var total=0;
      $("input[type=radio]:checked").each(function(){
        total=total+parseInt($(this).val());
      }) 
      $("input[type=checkbox]:checked").each(function(){
        total=total+parseInt($(this).val());
      })      
      $("#result").html(total);
      $("#tl").html("₺");
    })
  })

</script>
</html>