<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <br><br><br>

            <div class="card">
                <div class="card-header">
                    Create New Recode
                </div>
                <div class="card-body">
                    <!-- <h5 class="card-title"> Form</h5> -->
                    <form @submit.prevent="createStaff">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" v-model="formData.name"  placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <!-- <input type="text" class="form-control" name="position" v-model="formData.position" placeholder="Enter Position"> -->
                            <select class='form-control' v-model='units'>
                                <option value='0' >Select a Position</option>
                                <option v-for='data in genders' :value='data.name' :key="data.id">{{ data.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" v-model="formData.email" placeholder="Enter email">
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
                            <button class="btn btn-primary">Create</button>
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
                formData: {
                    name: "",
                    position: "",
                    email : "",
                    status: "",
                    Lunch: "",
                    WIFI:"",
                },
                gender: 0,
                units: 0,
                genders: [
                    { id: 1, name: "ASE" },
                    { id: 2, name: "SE" },
                    { id: 3, name: "Accountant" },
                    { id: 4, name: "HR" },
                ],
                checkedFacilities: [],
                picked: "",
               

                 

            }
        },
        methods: {
            createStaff(){
                this.formData.position = this.units;
                this.formData.status = this.picked;


                this.formData.WIFI = this.WIFI_facility;
                this.formData.Lunch = this.Lunch_facility;

                console.log("create data", this.formData);
                axios.post("/Create" , this.formData).then((response) => {
                    this.$toaster.success('Recode Created')
                    this.$router.push("/");
                }).catch((error) => {
                    console.log("there is an error" + error);
                    this.$toaster.error('Create Failed' , error)

                })
            }
        },
        updated() {
            console.log("gender", this.gender);
            
        },
    }
</script>
