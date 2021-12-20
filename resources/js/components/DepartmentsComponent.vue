<template>
    <div class="container">
        
        <div class="row justify-content-center" style="margin-top:30px">
            <div class="col-md-12">
                <h4 class="text-center">Departments</h4>
            </div>
        </div>

        <div class="row justify-content-center" style="margin-top:30px">
            <div class="col-md-12">
                <div class="card" style="padding:10px">
                    <div class="row">
                        <div class="col-sm-6">
                            
                            
                            <div class="card">
                                <div class="card-header">
                                    Create New Recode
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="createDept">
                                        <div class="form-group">
                                            <label for="name">Department Name</label>
                                            <input type="text" class="form-control" name="name" v-model="formData.deptName"  placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Select a Unit </label>
                                                    <select class='form-control' v-model='units'>
                                                    <option value='0' >Select Unit</option>
                                                    <option v-for='data in genders' :value='data.name' :key="data.id">{{ data.name }}</option>
                                                    </select>
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
                                            <label for="name">Facilities</label><br>
                                            <input type="checkbox" id="WIFI" value="WIFI" v-model="checkedFacilities">
                                            <label for="WIFI">WIFI</label>
                                            <input type="checkbox" id="Lunch" value="Lunch" v-model="checkedFacilities">
                                            <label for="Lunch">Lunch</label>
                                            <input type="checkbox" id="AC" value="AC" v-model="checkedFacilities">
                                            <label for="AC">AC</label>
                                        </div>

                                        <!-- <div class="input-group">
                                            <img :src="previewImage" class="uploading-image" style="width:100px"/>
                                            <input type="file" accept="image/jpeg" @change='handleOnChange'>
                                        </div> -->

                                        <br>
                                        
                                        <div class="form-group">
                                            <button class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                            
                                </div>
                            </div>
        

                        </div>
                        <div class="col-sm-6">

                        </div>
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
            formData: {
                deptName: "",
                unit : "",
                status: "",
                facilities: "",
                // image: ""
            },
            picked: "",
            units: 0,
            genders: [
                { id: 1, name: "IT" },
                { id: 2, name: "Finance" },
                { id: 3, name: "Logistic" },
                { id: 4, name: "HR" },
            ],
            checkedFacilities: [],
            previewImage:null,
            image: '',
            
        }
    },
    methods: {
        createDept(){
            this.formData.unit = this.units;
            this.formData.status = this.picked;
            // this.formData.facilities = this.checkedFacilities
            this.formData.facilities = "WIFI"

            // const fromDataDemo = new FormData;
            // fromDataDemo.set('image', this.image);
            // this.formData.image = fromDataDemo;

            console.log("frpartment data" , this.formData);

            axios.post('/createDeptUnit', this.formData).then((response) => {
                console.log("imageg response", response);
                this.$toaster.success('Created')

            }).catch((errors) => {
                console.log("image upload error", errors);
            })
        },
        handleOnChange(e){
            this.image = e.target.files[0];

            const image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e =>{
                this.previewImage = e.target.result;
                console.log(this.previewImage);
            };

        },
        uploadImage(e){
            const image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e =>{
                this.previewImage = e.target.result;
                console.log(this.previewImage);
            };
        }
    },
    
}
</script>