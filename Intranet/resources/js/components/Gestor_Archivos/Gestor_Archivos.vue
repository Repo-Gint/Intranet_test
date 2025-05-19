<template>
  <div>
    <div class="row">
      <div class="col-lg-3 col-md-3">
        <div class="card">
          <form @submit.prevent="create_separator">
            <div class="card-header bg-gradient-success">
              <h5 class="card-title m-0">Nuevo Separador</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-form-label">Departamento</label>
                <v-select v-model="separator.Departament_id" :options="departament_list" label="Departament_ES"  required></v-select>
              </div>
              <div class="form-group">
                <label class="col-form-label">Separador:</label>
                <input type="text" class="form-control form-control-sm" v-model="separator.Name" required>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-success btn-sm btn-block">Agregar</button>
            </div>
          </form>
        </div>
        <form @submit.prevent="edit_separator(separator)" enctype="multipart/form-data" v-if="edit_Separator">
          <div class="card">
            <div class="card-header bg-gradient-gray-dark">
              Editar Separador
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-form-label">Departamento</label>
                <v-select v-model="separator.Departament_id" :options="departament_list" label="Departament_ES"  required></v-select>
              </div>
              <div class="form-group">
                <label class="col-form-label">Separador:</label>
                <input type="text" class="form-control form-control-sm" v-model="separator.Name" required>
                <span v-if="errors.Name" class="text-danger">{{errors.Name[0]}}</span>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <button class="btn btn-primary btn-sm btn-block" title="Guardar">
                    <i class="fa fa-save"></i>
                  </button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <button class="btn btn-danger btn-sm btn-block" title="Cancelar" @click="cancel_separator()">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="card">
          <form @submit.prevent="upload_files" enctype="multipart/form-data">
            <div class="card-header bg-gradient-success">
              <h5 class="card-title m-0">Subir Archivos</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="col-form-label">Departamento</label>
                <v-select v-model="upload.Departament" :options="departament_list" label="Departament_ES"  @input="load_separators" required></v-select>
              </div>
              <div class="form-group">
                <label class="col-form-label">Separador</label>
                <v-select v-model="upload.Separator_id" :options="separator_list" label="Name"  required></v-select>
              </div>
              <div class="custom-file">
                <label class="col-form-label">Archivos</label>
                <input type="file" @change='get_files' class="custom-file-input imagen" id="archivos" ref="Name_file" lang="es" accept=".pdf, .xlsx, .docx, .pptx" multiple>
                <label class="custom-file-label" for="archivos" id="etiqueta">Seleccionar Archivo</label>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-success btn-sm btn-block">Agregar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-2 col-md-2">      
        <a v-for="departament in departament_list" class="btn btn-primary" data-toggle="collapse" href="#"departament.id"" role="button" aria-expanded="false" aria-controls="collapseExample">
          {{ departament.Departament_ES }}
        </a>
      </div>
      <div class="col-lg-2 col-md-2"> 
        
          <div v-for="departament in departament_list" class="collapse" id="departament.id">
          <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
          </div>
        </div>
        
      </div>
    </div>
  </div>
</template>
<script>
  import Vue from 'vue'
  import vSelect from 'vue-select'

  Vue.component('v-select', vSelect)
  export default {
    data(){
      return {
        separator: {Name: '', Departament_id: ''},
        upload: {Name_file: [], Separator_id: '', Departament:'', Num: ''},
        edit_Separator: false,
        departament_list: [],
        separator_list:[],
        errors : [],

      }
    },
    created(){
      axios.get('/Departament_list').then(res => {
        this.departament_list = res.data;   
      })
    },
    methods:{
      create_separator(){
        this.errors =[];

        const params = {
          Name: this.separator.Name,
          Departament_id: this.separator.Departament_id['id']
        }
        console.log(params);
        axios.post('/Gestor_Archivo_Separador', params).then(res => {
          //this.opciones.push(res.data);
          console.log(res);
          toast.fire({
            icon: 'success',
            background: 'green',
            title: '<span style="color:#ffffff">Se creo con éxito !</span>'
          });

          this.separator.Name = '';
          this.separator.Departament_id = '';
        }).catch((error) => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors
          }
          if(error.response.status == 500){
            console.log(error.response)
            Swal.fire({
              icon: 'error',
              title: 'Oops... Error',
              text: error.response.data.message
            })
          }
          console.log(error.response)
        })
      },
      edit_form_separator(item){
        this.edit_Separator = true;
        this.separator.name = item.name;
        this.separator.Departament_id = item.Departament_id;
        this.separator.id = item.id;
        document.getElementById('etiqueta').innerHTML = "Seleccionar Archivo";     
      },
      edit_separator(item){
        this.errors =[];
        const params = {
          Name: this.separator.Name,
          Departament_id: this.separator.Departament_id
        }

        axios.put( '/Gestor_Archivo_Separador/'+item.id, params).then(res => {
          //const index = this.opciones.findIndex(item => item.id === item.id)

          toast.fire({
            icon: 'success',
            background: 'green',
            title: '<span style="color:#ffffff">Se edito con éxito !</span>'
          });

          this.separator = {Name: '', Departament_id: ''}
          this.edit_Separator = false;
          document.getElementById('etiqueta').innerHTML = "Seleccionar Archivo";
        }).catch(error => {   
          if(error.response.status == 422){
              this.errors = error.response.data.errors
          }
          if(error.response.status == 500){
              console.log(error.response)
              Swal.fire({
                icon: 'error',
                title: 'Oops... Error',
                text: error.response.data.message
              })
          }
        })

        
      },
      cancelar_opcion(){
        this.separator = {Name: '', Departament_id: ''}
        this.edit_Separtador = false;
      },
      get_files(e){
        
        //this.upload.Name_file = e.target.files;
       // for (var i = 0; i < this.$refs.Name_file.files.length; i++) {
          this.upload.Name_file = this.$refs.Name_file.files;
       // }
        
        this.upload.Num = this.upload.Name_file.length;
        
      },
      load_separators(){
        axios.get('/Separator_list/'+this.upload.Departament['id']).then(res => {
          this.separator_list = res.data; 
        })
      },
      upload_files(){
        this.errors =[];

        let formData = new FormData();

        //console.log(this.upload.Name_file);
        for( var i = 0; i < this.upload.Name_file.length; i++ ){
          formData.append('Name_file['+i+']', this.upload.Name_file[i]);
          //console.log(this.upload.Name_file[i]);
        }

        formData.append('Num', this.upload.Num);
        formData.append('Separator_id', this.upload.Separator_id['id']);
        formData.append('Separator', this.upload.Separator_id['Name']);
        formData.append('Departament', this.upload.Departament['Departament_ES']);
//console.log(formData);
        axios.post('/Gestor_Archivo', formData).then(res => {
          //this.opciones.push(res.data);
          //console.log(res);
          toast.fire({
            icon: 'success',
            background: 'green',
            title: '<span style="color:#ffffff">Se creo con éxito !</span>'
          });

          this.upload.Name_file = '';
          this.upload.Separator_id = '';
          this.upload.Departament = '';
          document.getElementById('etiqueta').innerHTML = "Seleccionar Archivo";
        }).catch((error) => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors
          }
          if(error.response.status == 500){
            console.log(error.response)
            Swal.fire({
              icon: 'error',
              title: 'Oops... Error',
              text: error.response.data.message
            })
          }
          console.log(error.response)
        })
      },
      visualizar(id){
        alert(id);
      }
    }
  }


</script>