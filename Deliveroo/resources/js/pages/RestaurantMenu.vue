<template>
    <div class="my_container-items">
        <div class="row m-5">
            <h2>Nome ristorante</h2>
            <div class="card col-12">
                <div class="card-body" v-if="users != null">
                    <h5 class="card-title">{{users.restaurant_name}}</h5>
                </div>
            </div>

            <h1>{{newCart}}</h1>
            <div class="flex">

                <div action="" class="row first-box" >
                    <div class="p-2 col-4" v-for="item in items" :key="item.id">
                        <div class="card p-4">
                            <h1>{{item.item_name}}</h1>
                            <span class="py-2">{{item.description}}</span>
                            <h4 class="py-2">{{item.price}}</h4>
                            <span>AGGIUNGI PIATTO</span>
                            <button type="submit" @click="addToCart(item.id)" class="btn btn-warning">test</button>

                            <!-- <input class="form-check-input box" type="checkbox" v-model="cart" :value="item.id" :id="'item_' + item.id"> -->


                        </div>
                    </div>
                    <!-- <div>
                        <button type="submit" class="btn btn-warning mt-4">AGGIUNGI PIATTI AL CARRELLO</button>
                    </div> -->
                </div>

                <div class="carrello">
                    <h1 class="m-2">carrello</h1>
                    <!-- <div class="card-box" v-if="dati != []">
                        <div class="card" v-for="dato in dati" :key="dato.name">
                            <div v-if="dato.visible = 1">
                                <h3>{{dato.item_name}}</h3>
                                <h5>{{dato.price}}</h5>
                            </div>
                        </div>

                    </div> -->

                    <div class="card-box">
                        <div class="card" v-for="dato in dati2" :key="dato.name">
                        <div ></div>
                            <div v-if="dato.visible = 1">
                                <h3>{{dato.item_name}}</h3>
                                <h5>{{dato.price}}</h5>
                                <button type="submit" @click="delate(dato.id)" class="btn btn-danger">delate</button>
                            </div>
                        </div>

                    </div>

                    <h1 class="mt-4">Totale</h1>

                    <h3 v-if="totale != null">{{totale}}.00</h3>
                    <h3 v-else>{{newTotale}}.00</h3>

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
            dati2: [],
            altriDati: [],

            test: this.$route.params.slug,
            cart:[],

            totale: null,
            totale2: null,
            newTotale: null,

            newCart: null

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

        // addToCart(){
        //     this.dati = [];
        //     const slug = this.$route.params.slug;
        //     console.log('/api/user/' + slug + '/' + this.cart)

        //     if(this.cart.length > 0){
        //         axios.get('/api/user/' + slug + '/' + this.cart) .then(response =>{
        //             this.dati = response.data.results;
        //             console.log(response.data);

        //             const array1 = response.data.price;

        //             const initialValue = 0;
        //             const sumWithInitial = array1.reduce(
        //             (previousValue, currentValue) => previousValue + currentValue,
        //                 initialValue
        //             );

        //             console.log(sumWithInitial);
        //             this.totale = sumWithInitial;
        //         })
        //     }else{

        //         this.dati = [];
        //     }

        // },

        addToCart(id){
            const slug = this.$route.params.slug;
            this.cart.push(id)
            console.log('/api/user/' + slug + '/' + id)


                axios.get('/api/user/' + slug + '/' + id) .then(response =>{
                    this.dati.push(response.data.results)
                    console.log(response);
                    console.log('ssssssssssssssssssss');

                    this.dati2=this.dati.flat()

                    const array1 = response.data.price;

                    const initialValue = 0;
                    const sumWithInitial = array1.reduce(
                    (previousValue, currentValue) => previousValue + currentValue,
                        initialValue
                    );

                    console.log(sumWithInitial);
                    this.totale += sumWithInitial;
                })

            if (localStorage.cart) {
                this.newCart = localStorage.cart;
            }

            if (localStorage.totale) {
                this.newTotale = localStorage.totale;
            }

        },

        getItemCart(){

            const cart = this.newCart;
            const slug = this.$route.params.slug;
            console.log('/api/user/' + slug + '/' + cart + '/' + this.newCart)
            console.log(this.newCart)

            axios.get('/api/user/' + slug + '/' + cart + '/' + this.newCart).then(response => {
                this.dati.push(response.data.results);
                this.dati2=this.dati.flat()

                console.log(response.data.results);
                console.log('wwwwwwwwww');
            })

            .catch(error => {
                console.log(error);
            })

            this.cart = []


        },


    },

    mounted() {

        this.getItemCart();

    },

    watch: {
        cart(newCart) {
        localStorage.cart = newCart;
        console.log(localStorage);
        },

        totale(newTotale) {
        localStorage.totale = newTotale;
        console.log(localStorage);
        }

    },

    created() {
        this.getSlug();
        this.addToCart();

        if (localStorage.cart) {
            this.newCart = localStorage.cart;
        }

        if (localStorage.totale) {
            this.newTotale = localStorage.totale;
        }
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
