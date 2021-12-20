<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Edit your Recode
                </div>
                <div class="card-body">
                    <h5 class="card-title"> Form</h5>
                    <form @submit.prevent="EditStaff">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" v-model="staff.name"  placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <!-- <input type="text" class="form-control" name="position" v-model="staff.position" placeholder="Enter Position"> -->
                            <select class='form-control' v-model='staff.position'>
                                <option value='0' >Select a Position</option>
                                <option v-for='data in genders' :value='data.name' :key="data.id">{{ data.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" v-model="staff.email" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name">Facilities</label><br>
                                    <input type="checkbox" id="WIFI" value="WIFI" v-model="WIFI_facility">
                                    <label for="WIFI">WIFI</label>
                                    <input type="checkbox" id="Lunch" value="Lunch" v-model="Lunch_facility">
                                    <label for="Lunch">Lunch</label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Status</label><br>
                                    <input type="radio" id="Enable" value="Enable" v-model="picked">
                                    <label for="Enable">Enable</label>
                                    <input type="radio" id="Disable" value="Disable" v-model="picked">
                                    <label for="Disable">Disable</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-secondary">Update</button>
                        </div>
                    </form>
            
                </div>
            </div>
       
                    

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                WIFI_facility: false,
                Lunch_facility:false,
                staff:{},
                genders: [
                    { id: 1, name: "ASE" },
                    { id: 2, name: "SE" },
                    { id: 3, name: "Accountant" },
                    { id: 4, name: "HR" },
                ],
                picked: "",

            }
        },
        methods: {
            getStaff(){
                axios.get("getSingleStaff/" + this.$route.params.id ).then((response) => {
                    this.staff = response.data;
                    console.log("single stafff details", this.staff);
                    if(this.staff.WIFI == true){
                        this.WIFI_facility = true
                    }

                    if(this.staff.Lunch == true){
                        this.Lunch_facility = true
                    }

                    if(this.staff.status == "Enable"){
                        this.picked = "Enable"
                    }else{
                        this.picked = "Disable"
                    }

                }).catch((errors) => {
                    console.log("Errors in edit component in getStaff funcion" , errors);
                })
            },
            EditStaff(){
                this.staff.WIFI = this.WIFI_facility;
                this.staff.Lunch = this.Lunch_facility;
                this.staff.status = this.picked;
                axios.post("updateStaff/" + this.$route.params.id , this.staff).then((response) => {
                    this.$toaster.info('Recode Updated')
                    this.$router.push("/");
                }).catch((error) => {
                    console.log("There is an error on edit component in editStaff function" + error);
                    this.$toaster.error('Update Failed' , error)

                })
            }
        },
        mounted() {
            this.getStaff();
        },

    }
</script>
