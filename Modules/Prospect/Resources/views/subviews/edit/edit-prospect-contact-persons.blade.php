<div class="card">
    <div id="prospect_contact_person_form" class="collapse show" data-parent="#edit_client_form_container">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    Name
                </div>
                <div class="col-3">
                    Email
                </div>
                <div class="col-2">
                    Phone
                </div>
                <div class="col-4">
                    
                </div>
            </div>

            <div class="row mt-3" v-for="(contactPerson, index ) in this.contactPersons" :key="'contact-person' + '' + contactPerson.id">
                <input v-if="!(contactPerson.temp)" :value="contactPerson.id" class="form-control" type="hidden" :name="`prospect_contact_persons[${index}][id]`">
                <div class="col-3">
                    <input v-model="contactPerson.name" autocomplete="nope"  class="form-control" type="text" :name="`prospect_contact_persons[${index}][name]`" required="required">
                </div>
                <div class="col-3">
                    <input v-model="contactPerson.email" autocomplete="nope"  class="form-control" type="email" :name="`prospect_contact_persons[${index}][email]`">
                </div>
                <div class="col-2">
                    <input v-model="contactPerson.phone"  class="form-control" type="tel" :name="`prospect_contact_persons[${index}][phone]`">
                </div>
                <div class="col-4 d-flex justify-content-between">
                    {{-- <div class="mr-3 w-full">
                        <select required="required" v-model="contactPerson.type" class="form-control" :name="`prospect_contact_persons[${index}][type]`">
                            <option value="biiling-contact">Primary billing contact</option>
                            <option value="general-contact">General Point of contact</option>
                        </select>
                    </div> --}}

                    <div class="mt-1">
                        <button v-on:click="removeContactPerson(index)"  type="button" class="btn btn-sm text-danger"> remove </button>
                    </div>
                </div>
            </div>

            <div>
                <p class='btn mt-5 pl-0' v-on:click="addNewContactPerson()"  style="text-decoration: underline;">Add new contact person</p>   
            </div>
        
        </div>
        <div class="card-footer">
            @include('prospect::subviews.edit.edit-prospect-form-submit-buttons')
        </div>
    </div>
</div>


@section('js_scripts')
<script>
    new Vue({
        el:'#prospect_contact_person_form',

        data() {
            return {
               contactPersons:@json($contactPersons) 
            }
        },

        methods: {

            newContactPerson() {
                return {
                    id: new Date().getTime(),
                    temp:true,
                    name:'',
                    email:'',
                    phone:'',
                    type:'billing-contact'
                }
            },

            addNewContactPerson() {
                this.contactPersons.push(this.newContactPerson());
            },

            removeContactPerson(index) {
                this.contactPersons.splice(index, 1);
            }

        },

        mounted() {
            if(!this.contactPersons.length) {
                this.addNewContactPerson();
            }
        }
    })
</script>
@endsection