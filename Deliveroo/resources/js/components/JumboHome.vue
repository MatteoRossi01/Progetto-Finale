<template>
    <!-- inizio jumbotron -->
    <div class="jumbotron-container">
        <div class="col-8 m-auto">
            <div class="row jumbotron-contents col-7">
                <h1 class="jumbotron_title">Cosa ti prendi?</h1>
                <p class="jumbotron_subtitle">Con Deliveboo puoi mangiare quello che vuoi, quando vuoi, dove vuoi</p>
                <div class="col">
                    <router-link class="text-white button"  :to="{name: 'menu'}">INIZIA SUBITO!</router-link>
                </div>
            </div>

        </div>

    </div>

</template>

<script>
export default {
        data() {
            return {
                navLinks: [
                            {
                                to : 'menu',
                                name : 'Menù',
                            },
                        ]
            }
        }

}
</script>

<style scoped lang="scss">

@import '../../sass/_variables.scss';

//all jumbotron rules

.jumbotron-container {
    min-height: 450px;
    margin-top: 66px;
    background-image: url('../assets/images/food.jpg');
    background-size: cover;

    .jumbotron-contents {
        //color: $third;
        vertical-align: middle;
        transform: translateY(50%);
        transform: translateX(100%);
        font-size: xx-large;
        padding: 10px;
        


        .jumbotron_title {
            font-size: 95px;
            font-weight: 700;
            color: $purple;
            margin-top: 15px;
            font-family: 'Raleway', sans-serif;
            font-weight: 700;
        }

        .jumbotron_subtitle {
            font-size: 16px;
            font-family: 'Tenor Sans', sans-serif;
            color: #9538f2;
        }

        .button {
            //@include all_caps_button;
            display: inline-block;
            background-color: #9538f2;
            padding: 6px 16px;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            border-radius: 5px;
            //box-shadow: 0 4px 0 #7633b9;
            transition: all 0.3s;
            margin-left: 10px;
            font-size: 12px;
            font-weight: 700;
            &:hover {
                color: $orange;
            }

            span {
                padding-left: 10px;
            }
        }
    }

}

</style>