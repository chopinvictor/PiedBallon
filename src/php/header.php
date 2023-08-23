<style>
body{
    margin:0;
    color: white;
    font-family: Helvetica;
    text-shadow: 0 0 2px black;
}
#header{
    height: 64px;
    width: 100%;
    background-color: #386641;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}
.margin-s{
    margin: 8px;
}
#header_logo{
    width: 50px;
    margin: 10px 10px 10px 30px;
}
.logo-small{
    width: 25px;
}
.flex-row{
    display: flex;
    flex-direction: row;
}
</style>

<div id="header">
    <div class="flex-row">
        <img src="../assets/logo.svg" id="header_logo"/>
        <h2>PiedBallon</h2>
    </div>
    <div class="flex-row">
       <div class="flex-row">
            <img src="../assets/account.svg" class="logo-small"/>
            <h4 class="margin-s">COMPTE</h4>
       </div>

    </div>
</div>
