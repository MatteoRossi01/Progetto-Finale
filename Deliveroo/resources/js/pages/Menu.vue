<template>
    <main>
       <div class="my_container-menu">

           <div class="my_row-menu-1">

               <form action="" class="my_box" @submit.prevent="filteredType()">
                    <div class="my_box-input" v-for="typex in types" :key="typex.id">
                        <div class="my_input-item checkbox path">
                            <input type="checkbox" v-model="selected" :value="typex.id" :id="'typex_' + typex.id">
                            <svg viewBox="0 0 21 21">
                                <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                            </svg>
                            <label class="my_label-input" :for="'typex_' + typex.id">{{typex.name}}</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Cerca</button>
                    </div>
               </form>

            </div>

            <div class="my_row-menu-2">

                <div class="my_box-title">
                    <h1 class="menu-title">Benvenuto nella sezione ristoranti!</h1>
                    <span class="menu-text">Seleziona un ristorante per scoprire il menù!</span>
                </div>

                <div class="my_box-items">
                    <div class="my_col-menu " v-for="user in users" :key="user.id">
                        <Singolo
                            :title='user.restaurant_name'
                            :type='user.type'
                            :slug='user.slug'
                        />

                    </div>
                </div>
                    
            </div>
       </div>
    </main>


</template>

<script>
    import Singolo from '../components/Singolo.vue'

    export default {
        name: "Menu",
        components: {
            Singolo
        },

        data() {
            return {
                types: null,
                selected: [],
                users: [],

                navLinks: [
                {
                    to : 'restaurant-menu',
                    name : 'menu',
                },
            ]
            };
        },

        methods:{

            getTypes(){
                // prelevo tutte le tipologie
                axios.get('api/types').then(response =>{
                    this.types = response.data.results;
                })
            },

            getUsers(){
                axios.get('/api/users').then(response => {
                    this.users = response.data.results;
                    // console.log(response.data.results)
                    // console.log('aaaaaaaaaaaaa')
                })

                .catch(error => {
                    console.log(error);
                })

            },

            filteredType(){
                this.users = [];

                console.log('api/users/'+ this.selected)

                if(this.selected.length > 0){
                    axios.get('api/users/'+ this.selected) .then(response =>{
                        this.users = response.data.results;
                        //console.log(response.data.results)
                        //console.log('bbbbbbbbbbbb')
                    })
                }else{
                    this.getUsers();
                }

            }
        },

        created(){
            this.getTypes();
            this.getUsers();
        },
    }
</script>

<style lang="scss">

    .my_container-menu {
        width: 100%;
        display: flex;
        flex-direction: column;
        position: relative;

        .my_row-menu-1 {
            width: 15%;
            height: calc(100vh - 65.6px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 0;

            .my_box {
                width: 77%;

                .my_box-input {
                    width: 100%;

                    .my_label-input {
                        font-size: 15.5px;
                        font-weight: 600;
                        color: #FF4718;
                        margin-left: 30px;
                        margin-top: 2px;
                        cursor: pointer;
                    }

                    .my_input-item {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                    }

                    .checkbox {
                        --background: #fff;
                        --border: #D1D6EE;
                        --border-hover: #BBC1E1;
                        --border-active: #9538f2;
                        --tick: #fff;
                        position: relative;

                        input,
                        svg {
                            width: 17px;
                            height: 17px;
                            display: block;
                        }
                        input {
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            position: relative;
                            outline: none;
                            background: var(--background);
                            border: none;
                            margin: 0;
                            padding: 0;
                            cursor: pointer;
                            border-radius: 4px;
                            transition: box-shadow .3s;
                            box-shadow: inset 0 0 0 var(--s, 1px) var(--b, var(--border));
                            &:hover {
                                --s: 2px;
                                --b: var(--border-hover);
                            }
                            &:checked {
                                --b: var(--border-active);
                            }
                        }
                        svg {
                            pointer-events: none;
                            fill: none;
                            stroke-width: 2px;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke: var(--stroke, var(--border-active));
                            position: absolute;
                            top: 4;
                            left: 0;
                            width: 17px;
                            height: 17px;
                            transform: scale(var(--scale, 1)) translateZ(0);
                        }
                        &.path {
                            input {
                                &:checked {
                                    --s: 2px;
                                    transition-delay: .4s;
                                    & + svg {
                                        --a: 16.1 86.12;
                                        --o: 102.22;
                                    }
                                }
                            }
                            svg {
                                stroke-dasharray: var(--a, 86.12);
                                stroke-dashoffset: var(--o, 86.12);
                                transition: stroke-dasharray .6s, stroke-dashoffset .6s;
                            }
                        }
                        &.bounce {
                            --stroke: var(--tick);
                            input {
                                &:checked {
                                    --s: 11px;
                                    & + svg {
                                        animation: bounce .4s linear forwards .2s;
                                    }
                                }
                            }
                            svg {
                                --scale: 0;
                            }
                        }
                    }

                    @keyframes bounce {
                        50% {
                            transform: scale(1.2);
                        }
                        75% {
                            transform: scale(.9);
                        }
                        100% {
                            transform: scale(1);
                        }
                    }

                }
            }
        }

        .my_row-menu-2 {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 100px;
            width: 85%;
            align-self: flex-end;

            .my_box-items {
                display: flex;
                flex-direction: row;
                justify-content: center;
                margin-top: 26px;
                flex-wrap: wrap;
                width: 100%;
                align-self: flex-end;
            }

            .my_col-menu {
                padding: 10px 10px;
            }

            .my_box-title {
                display: flex;
                flex-direction: column;
                align-items: center;

                .menu-title {
                    font-weight: bold;
                    color: #9538f2;
                }

                .menu-text {
                    color: #FF4718;
                }
            }
        }
    }

</style>
