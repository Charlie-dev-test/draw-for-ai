<template>
    <div class="wrap">
        <header>
            <router-link class="logo" to="/">
                <img src="@/assets/img/logo.png" alt="datamist-logo">
            </router-link>
            <ul class="nav">
                <li><router-link class="link" to="/login">Login/Register</router-link></li>
            </ul>
        </header>
        <section class="content">
            <slot/>
        </section>
        <footer>
            <router-link to="/useragreement" class="footer-link">Пользовательское соглашение</router-link>
            <a href="mailto:admin@datamist.com" class="footer-link">admin@datamist.com</a>
        </footer>
    </div>
</template>

<script>
    export default {
        name: "Default"
    }
</script>

<style scoped lang="scss">
    .wrap{
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }
    header{
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex: 0 0 auto;
        background-color: #eaeaea;
    }

    footer{
        height: 70px;
        flex: 0 0 auto;
        background-color: #313232;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .content{
        flex: 1 0 auto;
    }

    ul{
        list-style: none;
        margin: 0;
        color: white;
    }

    li{
        color: black;
        display: inline;
        margin: 0 5px;
    }

    .link{
        color: black;
        text-decoration: none;
        margin-left: 10px;
        margin-right: 10px;
    }
    .logo{
        margin-top: 5px;
        img{
            width: 150px;
        }
    }
    .footer-link{
        color: white;
    }
</style>