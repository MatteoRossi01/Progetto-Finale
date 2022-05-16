<template>
    <div class="my_container-items">
        <div class="row m-5">
            <h2>Nome ristorante</h2>
            <div class="card col-12">
                <div class="card-body" v-if="users != null">
                    <h5 class="card-title">{{users.restaurant_name}}</h5>
                </div>
            </div>

            <!-- <h2 class="mt-4">Menù</h2>
            <h4>seleziona i piatti che desideri</h4>
             <div class="card col-12">
                <div v-for="item in items" :key='item.id'>
                    <h5 class="card-title">{{item.item_name}}</h5>
                </div>
            </div> -->
             <div class="flex">

                <form action="" class="row first-box" @submit.prevent="addToCart()">
                    <div class="p-2 col-4" v-for="item in items" :key="item.id">
                        <div class="card p-4">
                            <h1>{{item.item_name}}</h1>
                            <span class="py-2">{{item.description}}</span>
                            <h4 class="py-2">{{item.price}}</h4>
                            <span>AGGIUNGI PIATTO</span>
                            <input class="form-check-input box" type="checkbox" v-model="cart" :value="item.id" :id="'item_' + item.id">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning mt-4">AGGIUNGI PIATTI AL CARRELLO</button>
                    </div>
                </form>

                <div class="carrello">
                    <h1 class="m-2">carrello</h1>
                    <div class="card-box">
                        <div class="card" v-for="dato in dati" :key="dato.name">
                            <div v-if="dato.visible = 1">
                                <h3>{{dato.item_name}}</h3>
                                <h5>{{dato.price}}</h5>
                            </div>
                        </div>

                    </div>

                    <h1 class="mt-4">Totale</h1>
                    <h3 v-if="totale != null">{{totale}}.00</h3>
                    <router-link class="btn btn-primary"  :to="{name: 'checkout', params:{cart: newCart, price: totale}}">vai al pagamento</router-link>
                </div>

            </div>



        </div>
    </div>
</template>

<script>



export default {
    name: 'RestaurantMenu',
    data: function(){
        return {
            users: [],
            items: [],
            dati: [],
            test: this.$route.params.slug,
            cart:[],
            totale: null,
            newCart:[]

        }
    },



    methods: {
        getSlug(){
            const slug = this.$route.params.slug;
            // console.log(slug)
            // console.log('/api/users/' + slug)

            axios.get('/api/user/' + slug).then(response => {
                this.users = response.data.users;
                this.items = response.data.items;
                // console.log(response.data.users);
                console.log(response.data.items);
                // console.log('ddddddd');
            })

            .catch(error => {
                console.log(error);
            })

        },

        addToCart(){
            this.itemsCart = []
            const slug = this.$route.params.slug;
            console.log('/api/user/' + slug + '/' + this.cart)

            if(this.cart.length > 0){
                axios.get('/api/user/' + slug + '/' + this.cart) .then(response =>{
                    this.dati = response.data.results;
                    console.log(response.data);

                    const array1 = response.data.price;

                    const initialValue = 0;
                    const sumWithInitial = array1.reduce(
                    (previousValue, currentValue) => previousValue + currentValue,
                        initialValue
                    );

                    console.log(sumWithInitial);
                    this.totale = sumWithInitial;
                })
            }else{

                this.dati = [];
            }

        },


    },
    mounted() {
        if (localStorage.cart) {
        this.newCart = localStorage.cart;
        this.price = this.totale;
        }
    },

    watch: {
        cart(newCart) {
        localStorage.cart = newCart;
        console.log(localStorage);
        }

    },

    created() {
        this.getSlug();
    }
}
</script>

<style lang="scss" scoped>
.my_container-items {
    margin-top: 66px;
}

.flex{
    display: flex;

    .first-box{
        width: 60%;
        padding: 0px 30px;
        overflow-y: auto;
    }
    .carrello{
        width: 40%;
        height: 510px;
        background-color: aqua;

        margin: 10px 0px;

        .card-box{
            height: 320px;
            overflow-y: auto;
            margin: 10px;
        }

        .card{
            margin: 10px;

        }
    }

    .box{
        width: 100%;
        height: 30px;
        text-align: center;
    }
}

</style>
