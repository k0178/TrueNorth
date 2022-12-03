<div class="head"> 
    <h1>TRUE NORTH GARMENTS</h1>
    <img src="{{ asset('/img/tnglogo.png') }}" width="300px" height="150px" class="imgh"/> 
</div>

<div class="card">
    <div class="container">
        <h2>Hello, {{$name}}!</h2>
        <p>
            You have Successfully paid our Membership fee of Php 1000.000. Congratulations! You may now participate in biddings.
        </p>
        <p class="h4">
            Thank you and kind regards!
        </p>
    </div>
  </div>


  <style>

    body{
        font-family: Arial, Helvetica, sans-serif;
    }


    .imgh{
        margin-right: auto;
        margin-left: auto;
        padding: 5px;
    }
    .head{
        text-align: center;
        margin: auto;
        padding: 10px;
 
        width: 50%;
    }

    .card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border:2px solid navy;
  text-align: center;
  width: 75%;
  margin: auto;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
  </style>