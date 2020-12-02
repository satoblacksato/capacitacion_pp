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
        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class=" flex flex-wrap -mx-1 lg:-mx-4 grid grid-cols-1 md:grid-cols-3">

                <div class="md:flex bg-white rounded-lg p-4 m-2" v-for="(book,idx) in books.data" >
                    <img class="h-16 w-16 md:h-24 md:w-24 rounded-full mx-auto md:mx-0 md:mr-6"
                          :src="book.user_created.profile_photo_url"/>
                    <div class="text-center md:text-left">
                        <h2 class="text-lg"> {{book.name}}</h2>
                        <div class="text-purple-500">{{book.user_created.name}}</div>
                        <div class="text-gray-600"> {{book.created_at}}</div>
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
            books:[]
        }
    },
    mounted() {
        axios.get(this.route)
        .then(response =>(this.books=response.data.books) )
    }
}
</script>
<style scoped>

</style>
