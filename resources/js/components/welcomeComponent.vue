<template>
        
    <div class="container">
        <div style="height:80px; background-color:black">
            <h2 class="text-center" style="color:white; padding-top:20px;">OpusXenta (PVT) Ltd</h2>
        </div>
        
        <div class="row justify-content-center" style="margin-top:30px">
            <div class="col-md-12">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Departments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <!-- Staff tab section start here -->
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <!-- Create button and search section start here -->
                        <div class="row justify-content-center" style="margin-top:20px">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6 float-left">
                                        <router-link to="/Create" class="btn btn-primary">Create Staff</router-link>
                                    </div>
                                    <div class="col-sm-6">
                                        <form >
                                            <div class="row float-right" style="margin-right:0px">
                                                <input type="text" @keyup="fetchdataStaff()" v-model="search" name="search"  placeholder="Search Staff Member" style="margin-right:10px">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Staff list table section start here -->
                        <div class="row justify-content-center" style="margin-top:20px">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead >
                                        <tr>
                                            <th>#</th>
                                            <th>
                                                <a href="" @click.prevent="changeSort('name')">Name</a>
                                                <span v-if="sort_direction == 'desc' && sort_field == 'name'">&uarr;</span>
                                                <span v-if="sort_direction == 'asc' && sort_field == 'name'">&darr;</span>
                                            </th>
                                            <th>
                                                <a href="" @click.prevent="changeSort('position')">Position</a>
                                                <span v-if="sort_direction == 'desc' && sort_field == 'position'">&uarr;</span>
                                                <span v-if="sort_direction == 'asc' && sort_field == 'position'">&darr;</span>
                                            </th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <input type="text" v-model="name" name="name" @keyup="fetchdataStaff()" placeholder="Filter by Name">
                                            </th>
                                            <th>
                                                <input type="text" v-model="position" name="position" @keyup="fetchdataStaff()" placeholder="Filter by Position">
                                            </th>
                                            <th>
                                            </th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(staff, index) in staff.data" :key="index"> 
                                            <td>{{index + 1}}</td>
                                            <td>{{staff.name}}</td>
                                            <td>{{staff.position}}</td>
                                            <td>
                                                <span v-if="staff.status == 'Enable'" class="badge badge-success">Enable</span>
                                                <span v-if="staff.status == 'Disable'" class="badge badge-warning">Disable</span>
                                            </td>
                                            <td>{{staff.email}}</td>
                                            <td>
                                                <router-link :to="{name:'edit', params: {id : staff.id}}" class="btn btn-secondary">Edit</router-link>
                                                <a @click="deleteStaffMember(staff.id)"  class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination section start here -->
                        <div class="row justify-content-center" style="margin-top:20px">
                            <div class="col-md-12">
                                <pagination :data="staff"  @pagination-change-page="getStaff">
                                    <span slot="prev-nav">&lt; Previous</span>
                                    <span slot="next-nav">Next &gt;</span>
                                </pagination>
                            </div>
                        </div>

                    </div>
                    <!-- Staff tab section ends here -->

                    <!-- Department section start here -->
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <router-link to="/departments" class="btn btn-primary">Departments </router-link>
                        <hr>
                    </div>
                    <!-- Department section ends here -->

                    <!-- Contact section start here -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        contact section
                    </div>
                    <!-- Contact section ends here -->

                </div>

            </div>
        </div>
    </div>

 

</template>

<script>

    export default {
        data(){
            return{
                staff:{},                                   //  Staff Object
                searchQuery: null,                          //  Didn't use this variable
                search : "",                                //  search v model variable
                searchName: "",                             //  name column text field v model
                position:"",                                //  v model for postition
                name:"",                                    //  v model for name
                sort_direction:'desc',                      //  sorting direction variable
                sort_field: 'created_at'                    //  sorting field variable
            }
        },
        computed: function() {
            this.fetchdataStaff();
        },
        mounted() {
            this.getStaff();
            this.getResults();
        },
        methods: {

            // GET all staff function
            getStaff(page = 1) {
                axios.get('index?page=' + page + '&sort_direction=' + this.sort_direction + '&sort_field=' + this.sort_field).then((response) => {
                    this.staff = response.data;
                })
            },

            // Filter data function
            fetchdataStaff(){
                axios.get('searchStaff?search=' + this.search + '&name=' + this.name + '&position=' + this.position + '&sort_direction=' + this.sort_direction + '&sort_field=' + this.sort_field)
                .then(response => {
                    this.staff = response.data;
                });

            },

            // Sorting method
            changeSort(field){
                if(this.sort_field = field){
                    this.sort_direction = this.sort_direction == 'asc' ? 'desc' : 'asc'
                }else{
                    this.sort_field = field;
                }
                this.getStaff();
            },

            // Delete staff function
            deleteStaffMember(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post("staff/deleteStaff/"+ id).then((response) => {
                            this.getStaff();

                        }).catch((errors) => {
                            console.log("There sis an error on delete function", errors);
                        })
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                })
            },

            seachStaffByName() {
                return this.staff.filter(post =>
                    post.name.toLowerCase().includes(this.searchName.toLowerCase()),
                );
            }
        },
        
    }
</script>
