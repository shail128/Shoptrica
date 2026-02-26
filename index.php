<?php
session_start();
$conn=new mysqli("localhost","root","","shoptrica");
if(isset($_GET['add'])) $_SESSION['cart'][]=$_GET['add'];
$cat=isset($_GET['cat'])?$_GET['cat']:'';
?>
<!DOCTYPE html>
<html>
<head>
<title>Shoptrica</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--bg:#EAEFEF;--card:#BFC9D1;--dark:#25343F;--accent:#FF9B51}
body{margin:0;font-family:Poppins,Arial;background:var(--bg)}

.navbar{display:flex;align-items:center;gap:25px;padding:12px 20px;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.1);position:sticky;top:0;z-index:99}
.logo{font-size:24px;font-weight:700;color:var(--accent);text-decoration:none}
.menu{display:flex;gap:20px;font-weight:600}
.menu a{text-decoration:none;color:#333}
.search{flex:1}
.search input{width:100%;padding:9px 14px;border-radius:6px;border:1px solid #ddd}
.icons{display:flex;gap:20px;font-size:18px;text-align:center}
.icons a{color:#333;text-decoration:none}
.badge{background:var(--accent);color:#fff;border-radius:50%;padding:2px 6px;font-size:12px;position:relative;top:-8px;left:-8px}

.catRow{display:flex;gap:18px;overflow:auto;background:#fff;padding:12px 15px}
.catRow a{text-align:center;text-decoration:none;color:#333;font-size:13px;min-width:90px}
.catRow img{width:70px;height:70px;border-radius:18px;object-fit:cover}

.heroSlider{position:relative;width:100%;height:380px;overflow:hidden;background:#fff}
.hero{position:absolute;width:100%;height:100%;object-fit:cover;opacity:0;transition:1s}
.hero.active{opacity:1}
.dots{position:absolute;bottom:15px;left:50%;transform:translateX(-50%);display:flex;gap:8px}
.dots span{width:10px;height:10px;background:#fff;border-radius:50%;cursor:pointer;opacity:.6}

.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:15px;padding:15px}
.card{background:#fff;border-radius:12px;padding:10px}
.card img{width:100%;height:170px;object-fit:cover;border-radius:10px}
.btn{background:var(--accent);color:#fff;text-align:center;padding:8px;margin-top:6px;border-radius:8px;text-decoration:none;display:block}

.footer{background:var(--dark);color:#fff;padding:30px;text-align:center}
.social a{color:#fff;margin:0 10px;font-size:22px}
</style>
</head>
<body>

<div class="navbar">
<a class="logo" href="index.php">Shoptrica</a>
<div class="menu">
<a href="?cat=Men">MEN</a>
<a href="?cat=Women">WOMEN</a>
<a href="?cat=Kids">KIDS</a>
<a href="?cat=Home">HOME</a>
<a href="?cat=Beauty">BEAUTY</a>
<a href="?cat=GenZ">GENZ</a>
</div>
<div class="search"><input placeholder="Search products"></div>
<div class="icons">
<a href="#"><i class="fa-regular fa-user"></i><br>Profile</a>
<a href="#"><i class="fa-regular fa-heart"></i><br>Wishlist</a>
<a href="#"><i class="fa-solid fa-bag-shopping"></i><span class="badge"><?php echo count($_SESSION['cart']??[]); ?></span><br>Bag</a>
</div>
</div>

<div class="catRow">
<a href="?cat=Appliances"><img src="appliances.webp"><p>Appliances</p></a>
<a href="?cat=Beauty"><img src="beauty.webp"><p>Beauty</p></a>
<a href="?cat=Electronics"><img src="electronics.webp"><p>Electronics</p></a>
<a href="?cat=Fashion"><img src="faishon.webp"><p>Fashion</p></a>
<a href="?cat=Food"><img src="food.webp"><p>Food</p></a>
<a href="?cat=Furniture"><img src="furniture.webp"><p>Furniture</p></a>
<a href="?cat=Home"><img src="home.webp"><p>Home</p></a>
<a href="?cat=Mobiles"><img src="mobiles.webp"><p>Mobiles</p></a>
<a href="?cat=Sports"><img src="sports.webp"><p>Sports</p></a>
<a href="?cat=Toys"><img src="toys.webp"><p>Toys</p></a>
</div>

<div class="heroSlider">
<img class="hero active" src="banner1.jpg">
<img class="hero" src="banner2.jpg">
<img class="hero" src="banner3.jpg">
<img class="hero" src="banner4.jpg">
<div class="dots">
<span onclick="goSlide(0)"></span>
<span onclick="goSlide(1)"></span>
<span onclick="goSlide(2)"></span>
<span onclick="goSlide(3)"></span>
</div>
</div>

<div class="grid">
<?php
$q=$cat?"SELECT * FROM products WHERE category='$cat'":"SELECT * FROM products";
$res=$conn->query($q);
while($r=$res->fetch_assoc()){
?>
<div class="card">
<img src="uploads/<?php echo $r['image']; ?>">
<h4><?php echo $r['name']; ?></h4>
<b>₹<?php echo $r['price']; ?></b>
<a class="btn" href="?add=<?php echo $r['id']; ?>">Add Cart</a>
</div>
<?php } ?>
</div>

<div class="footer">
<h3>Connect With Me</h3>
<div class="social">
<a href="https://www.instagram.com/shailesh._129"><i class="fab fa-instagram"></i></a>
<a href="https://www.linkedin.com/in/shail-kumar-967b43293"><i class="fab fa-linkedin"></i></a>
<a href="mailto:shail1282003@gmail.com"><i class="fas fa-envelope"></i></a>
</div>
<p>© 2026 Shoptrica Developed by Shail</p>
</div>

<script>
let slides=document.querySelectorAll('.hero');
let index=0;
function showSlide(i){slides.forEach(s=>s.classList.remove('active'));slides[i].classList.add('active');index=i;}
function goSlide(i){showSlide(i);} 
setInterval(()=>{index=(index+1)%slides.length;showSlide(index);},3000);
</script>

</body>
</html>
