<template>
    <div>
        <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ category_name }}
        </h1>
        <br/>
        <p class="text-lg text-gray-600">
            Cantidad de libros: {{books.total}}
        </p>
        <br/>
        <div class="relative mr-6 my-2">
            <input type="search" class="bg-purple-white shadow rounded border-0 p-3" placeholder="Search by name..." v-model="bookName" @keyup="loadBooks">
            <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">
                <svg version="1.1" class="h-4 text-dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 52.966 52.966" style="enable-background:new 0 0 52.966 52.966;" xml:space="preserve">
    	<path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
        c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
        C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
        S32.459,40,21.983,40z"/>

	    </svg>

            </div>
        </div>

        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class=" flex flex-wrap -mx-1 lg:-mx-4 grid grid-cols-1 md:grid-cols-3 bg-gray-50">

                <div class="md:flex bg-white rounded-lg p-4 m-2 cursor-pointer" v-for="(book,idx) in books.elements" @click="gotoBook(book)">
                    <img class="h-16 w-16 md:h-24 md:w-24 rounded-full mx-auto md:mx-0 md:mr-6"
                          :src="book.user_created.profile_photo_url" style="width: 50px;height: 50px"/>
                        <div class="text-center md:text-left">
                            <h2 class="text-lg"> {{book.name}}</h2>
                            <div class="text-purple-500">{{book.user_created.name}}</div>
                            <div class="text-gray-600"> {{book.date_vue}}</div>
                        </div>

                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'BooksCategory',
    props: ['category_name','route'],
    data(){
        return{
            books:[],
            bookName:null,
            routeSearch:''
        }
    },
    mounted() {
        this.routeSearch=this.route;
        axios.get(this.routeSearch)
        .then(response =>(this.books=response.data.data) )
    },
    methods:{

        gotoBook: (book)=>{
            location.href=book.route_view;
        },

        loadBooks(){
            axios.get(this.routeSearch,{
                params: {
                        bookName:this.bookName
                }
            }).then(response =>(this.books=response.data.data) )
        }
    }
}
</script>
<style scoped>

</style>
