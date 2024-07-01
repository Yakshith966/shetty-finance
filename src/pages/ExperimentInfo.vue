<template>
    <div style="display: flex;flex-direction: column;align-items: center;">
        <!-- <div class="md-field md-theme-demo-light md-has-textarea">
           <label for="md-textarea-vtq0k1j2n">Textarea</label>
        <div class="row align-items-center mb-3">
          

        </div>
          
      </div> -->
      

        <div  class="page">
        <md-card>
            <div id="form"></div>
            <md-card-header data-background-color="green">
                <h4 class="title">Experiment Information</h4>      
            </md-card-header>
        <md-card-content>

          <div class="first-sec">
            <div>
            <div class="first-row">
                <div><label><span class="md-body-2">Trail No</span></label></div>
                <div>
                    <md-field>
                        <md-input v-model="initial" readonly></md-input>
                    </md-field>
                </div>
                <div><label><span class="md-body-2">Start Date</span></label></div>
                <div>
                    <md-datepicker v-model="selectedDate" md-immediately />
                </div>
            </div>
            </div>
            <div>
                <div><label><span class="md-body-2">Aim of the Experiment</span></label></div>
                <!-- <md-field>
                <md-textarea v-model="textarea" md-counter="100" class="custom-textarea"></md-textarea>
                </md-field> -->
                <textarea v-model="aim" rows="5" cols="64"></textarea>
                </div>
            <div>
                <div><label><span class="md-body-2">Methodology</span></label></div>
                    <!-- <md-field>
                        <label>Textarea</label>
                        <md-textarea v-model="textarea" md-counter="50" style="color:black;"></md-textarea>
                    </md-field> -->
                    <textarea v-model="meth" rows="5" cols="64"></textarea>
                </div>
        </div>
        <label class="test1"><span class="md-body-2">Treatment Details</span></label>
        <div class="structa1" id="structa1">
            <!-- <label for="country" class="test1"><span class="md-body-2">Employee Name</span></label> -->
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="treatmentDetails" id="country" md-dense>
                  <md-option value="T1">T1 Group</md-option>
                  <md-option value="T2">T2 Group</md-option>
                  <md-option value="T3">T3 Group</md-option>
                  <md-option value="T4">T4 Group</md-option>
                  <md-option value="T5">T5 Group</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" id="country" md-dense>
                  <md-option value="arial">Positive Control</md-option>
                  <md-option value="calibri">Control</md-option>
                  <md-option value="cambria">Negative Control 1</md-option>
                  <md-option value="comic-sans">Negative Control 2</md-option>
                  <md-option value="consolas">Negative Control 3</md-option>
                  <!-- <md-option value="courier">Negative Control </md-option>
                  <md-option value="droid-sans">Droid Sans</md-option>
                  <md-option value="georgia">Georgia</md-option>
                  <md-option value="helvetica">Helvetica</md-option>
                  <md-option value="impact">Impact</md-option>
                  <md-option value="roboto">Roboto</md-option>
                  <md-option value="segoe-ui">Segoe UI</md-option>
                  <md-option value="times-new-roman">Times New Roman</md-option>
                  <md-option value="ubuntu">Ubuntu</md-option>
                  <md-option value="verdana">Verdana</md-option> -->
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">T1 Group</md-option>
                  <md-option value="calibri">T2 Group</md-option>
                  <md-option value="cambria">T3 Group</md-option>
                  <md-option value="comic-sans">T4 Group</md-option>
                  <md-option value="consolas">T5 Group</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">Positive Control</md-option>
                  <md-option value="calibri">Control</md-option>
                  <md-option value="cambria">Negative Control 1</md-option>
                  <md-option value="comic-sans">Negative Control 2</md-option>
                  <md-option value="consolas">Negative Control 3</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">T1 Group</md-option>
                  <md-option value="calibri">T2 Group</md-option>
                  <md-option value="cambria">T3 Group</md-option>
                  <md-option value="comic-sans">T4 Group</md-option>
                  <md-option value="consolas">Consolas</md-option>
                  <md-option value="courier">Courier</md-option>
                  <md-option value="droid-sans">Droid Sans</md-option>
                  <md-option value="georgia">Georgia</md-option>
                  <md-option value="helvetica">Helvetica</md-option>
                  <md-option value="impact">Impact</md-option>
                  <md-option value="roboto">Roboto</md-option>
                  <md-option value="segoe-ui">Segoe UI</md-option>
                  <md-option value="times-new-roman">Times New Roman</md-option>
                  <md-option value="ubuntu">Ubuntu</md-option>
                  <md-option value="verdana">Verdana</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">Positive Control</md-option>
                  <md-option value="calibri">Control</md-option>
                  <md-option value="cambria">Negative Control 1</md-option>
                  <md-option value="comic-sans">Negative Control 2</md-option>
                  <md-option value="consolas">Negative Control 3</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">T1 Group</md-option>
                  <md-option value="calibri">T2 Group</md-option>
                  <md-option value="cambria">T3 Group</md-option>
                  <md-option value="comic-sans">T4 Group</md-option>
                  <md-option value="consolas">T5 Group</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">Positive Control</md-option>
                  <md-option value="calibri">Control</md-option>
                  <md-option value="cambria">Negative Control 1</md-option>
                  <md-option value="comic-sans">Negative Control 2</md-option>
                  <md-option value="consolas">Negative Control 3</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">T1 Group</md-option>
                  <md-option value="calibri">T2 Group</md-option>
                  <md-option value="cambria">T3 Group</md-option>
                  <md-option value="comic-sans">T4 Group</md-option>
                  <md-option value="consolas">T5 Group</md-option>
                </md-select>
              </md-field>
            </div>
            <div class="test2">
              <md-field>
                <label for="country">Select</label>
                <md-select required v-model="country" name="country" id="country" md-dense>
                  <md-option value="arial">Positive Control</md-option>
                  <md-option value="calibri">Control</md-option>
                  <md-option value="cambria">Negative Control 1</md-option>
                  <md-option value="comic-sans">Negative Control 2</md-option>
                  <md-option value="consolas">Negative Control 3</md-option>
                </md-select>
              </md-field>
            </div>
        </div>

        <label for="country" class="test1"><span class="md-body-2">Materials and Methods</span></label>
        <div class="struct-last">

          <label for="country" style="background-color: bisque;"><span class="md-body-2">Chicks</span></label>
          <label for="country" style="background-color: bisque;"><span class="md-body-2">Batch</span></label>
            
                <div><input type="text" v-model="chicks" id="fname" name="fname" style="width: 240px;"><br><br></div>
                <div><input type="text" v-model="batch" id="fname" name="fname" style="width: 240px;"><br><br></div>
            
        </div>
        <div class="struct-last">
          <label for="country" style="background-color: bisque;" ><span class="md-body-2">Description:</span></label>
          <label for="country" style="background-color: bisque;"><span class="md-body-2">Premix:</span></label>
                <textarea v-model="description" rows="5" cols="50"></textarea>
                <textarea v-model="premix" rows="5" cols="50"></textarea>
            
        </div>
            <div class="row-layout2a">
                <div id="buttons">
                        <div @click="displayData">
                        <md-button type="submit" class="md-success" >Save</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                        <md-button type="button" class="md-danger">Cancel</md-button>
                        </div>
                  </div>
            </div>  

        </md-card-content>
          </md-card>   
        </div>

        <div>
          <md-card>
                
               
                <md-card-header data-background-color="green">
                  <h4 class="title">EXPERIMENT INFO</h4>
                  <!-- <p class="category">List of Users</p> -->
              </md-card-header>
           
                  <md-card-content>     
                          
<table class="styled-table">
      <thead>
          <tr>
              <th>Trial No</th>
              <th>Date</th>
              <th>Aim of exp</th>
              <th>Methodology</th>
              <th>Treatment details</th>
              <th>Chicks</th>
              <th>Batch</th>
              <th>Description</th>
              <th>Premix</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="item in temp" :key="item.id">
              <td>
                  <template v-if="!item.isEditing">{{ item.initial }}</template>
                  <template v-else>
                    <input v-model="item.initial" class="custm"/>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.selectedDate }}</template>
                  <template v-else>
                    <input v-model="item.selectedDate" class="custm"/>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.aim }}</template>
                  <template v-else>
                    <input v-model="item.aim" class="custm"/>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.meth }}</template>
                  <template v-else>
                    <input v-model="item.meth" class="custm"/>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.treatmentDetails }}</template>
                  <template v-else>
                      <select v-model="item.treatmentDetails" class="slct2">
                        <option value="T1">T1 Group</option>
                  <option value="T2">T2 Group</option>
                  <option value="T3">T3 Group</option>
                  <option value="T4">T4 Group</option>
                  <option value="T5">T5 Group</option>
                      </select>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.chicks }}</template>
                  <template v-else>
                      <input v-model="item.chicks" class="custm"/>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.batch }}</template>
                  <template v-else>
                      <input v-model="item.batch" class="custm"/>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.description  }}</template>
                  <template v-else>
                      <input v-model="item.description" class="custm"/>
                  </template>
              </td>
              <td>
                  <template v-if="!item.isEditing">{{ item.premix }}</template>
                  <template v-else>
                      <input v-model="item.premix" class="custm"/>
                  </template>
              </td>
              
              <td>
                  <button v-if="!item.isEditing" @click="toggleEdit(item)">
                      <md-icon>edit_square</md-icon>
                  </button>
                  <button v-else @click="saveChanges(item)">
                      <md-icon>save</md-icon>
                  </button>
              </td>
              <!-- <td>
                <div class="t-cell" @click="removeFeedRow(row)" style="cursor: pointer;">
                              <md-icon>clear</md-icon>
                 </div>
              </td> -->
              
          </tr>
      </tbody>
  </table>
                  </md-card-content>
                
            
            </md-card>
        </div>
  
   
  </div>
  


  </template>
  
  <script>
  export default {
    
    name: "simple-table",
    props: {
      tableHeaderColor: {
        type: String,
        default: "",
      },
    },
    data() {
      return {
        id1:0,
        sec1:false,
        textarea: null,
    initial:"T1/10/22",
    selectedDate:'',
    aim:'',
    meth:'',
    treatmentDetails:'',
    chicks:'',
    batch:'',
    description:'',
    premix:'',
        activeTab: 'list', // Default active tab
        temp:[],
        users: [
          { name: "Dakota Rice", salary: "$36,738", country: "Niger", city: "Oud-Turnhout" },
          { name: "Minerva Hooper", salary: "$23,738", country: "Curaçao", city: "Sinaai-Waas" },
          { name: "Sage Rodriguez", salary: "$56,142", country: "Netherlands", city: "Overland Park" },
          { name: "Philip Chaney", salary: "$38,735", country: "Korea, South", city: "Gloucester" },
          { name: "Doris Greene", salary: "$63,542", country: "Malawi", city: "Feldkirchen in Kārnten" },
          { name: "Mason Porter", salary: "$78,615", country: "Chile", city: "Gloucester" },
        ],
        otherUsers: [
          { name: "Jane Doe", salary: "$48,000", country: "USA", city: "New York" },
          { name: "John Smith", salary: "$52,000", country: "UK", city: "London" },
          { name: "Juan Carlos", salary: "$44,000", country: "Spain", city: "Madrid" },
          { name: "Wei Zhang", salary: "$50,000", country: "China", city: "Beijing" },
        ],
      };
    },
    methods: {
      isActive(tab) {
        return this.activeTab === tab;
      },
      setActiveTab(tab) {
        this.activeTab = tab;
      },
      toggleEdit(item) {
        item.isEditing = !item.isEditing;
      },
      saveChanges(item) {
        item.isEditing = false;
        // Additional logic to save changes if needed
      },
      displayData(){
        this.temp.push({initial:"T1/10/22",
    selectedDate:this.selectedDate,
    aim:this.aim,
    meth:this.meth,
    treatmentDetails:this.treatmentDetails,
    chicks:this.chicks,
    batch:this.batch,
    description:this.description,
    premix:this.premix,
    isEditing: false
  })
      }

    }
  };
  </script>
  
  <style scoped>

/* .custom-md-field{
  /* Adjust the overall size of the md-field if needed 
  width: 190px; Adjust as needed 
} */


#form{
    display:flex;
    flex-direction:column;
    align-items:center;
}

.first-sec{
    display:flex;
    flex-direction: column;
}

.first-row{
    display:flex;
    flex-direction: row;
}

.structa1{
    display: grid;
    grid-template-columns: 240px 240px;
    grid-gap: 5px;
    grid-auto-rows: 50px; 
    
    /* padding-left:110px; */
    /*grid-auto-rows: 50px;  Set all rows to 50px height */
    /* border: 1px solid rgba(0, 0, 0, 0.8); */
}

.page{
  display: flex;
  flex-direction: column;
  align-items: center;
  /* width: 80%; */
}

.custom-md-input {
  /* Adjust the size of the input */
  width: 50px; /* Change the width as needed */
  /* height: 30px; Change the height as needed */
  /*padding: 5px;  Adjust padding as needed */
  font-size: 14px; /* Adjust font size as needed */
}
  .row {
    --ct-gutter-x: 1.5rem;
    --ct-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--ct-gutter-y));
    margin-right: calc(-0.5 * var(--ct-gutter-x));
    margin-left: calc(-0.5 * var (--ct-gutter-x));
  }
  
  .tab-content {
    padding: 20px 0 0 0;
    border: none;
  }
  
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: #71b6f9 !important;
  }
  
  .align-items-center {
    align-items: center !important;
    padding:0px 65px 0px 20px;
  }
  
  .mb-3 {
    margin-bottom: 1.5rem !important;
  }
  
  .col {
    flex: 1 0 0%;
  }
  
  .mt-0 {
    margin-top: 0 !important;
  }
  
  .header-title {
    font-size: 1rem;
    margin: 0 0 7px 0;
  }
  
  .test1{
    padding-top:30px;
    text-align: left;
  }

  .custom-textarea {
  max-height: 200px; /* Set a max height for the textarea */
  overflow-y: auto; /* Enable vertical scrolling */
  resize: vertical; /* Allow vertical resizing if needed */
}

/* Optional: Customize scrollbar appearance */
.custom-textarea::-webkit-scrollbar {
  width: 8px; /* Set the width of the scrollbar */
}

.custom-textarea::-webkit-scrollbar-thumb {
  background-color: #888; /* Set the color of the scrollbar thumb */
  border-radius: 4px; /* Set the border radius of the scrollbar thumb */
}

.custom-textarea::-webkit-scrollbar-thumb:hover {
  background-color: #555; /* Change the color on hover */
}

.struct-last{
    display:grid;
    grid-template-columns: 240px 240px;
    grid-gap: 5px;
    /* grid-gap: 10px;
    grid-auto-rows: 50px;  */
    /* border: 1px solid rgba(0, 0, 0, 0.8); */
    /* height: calc(100vh - 40px); */
}

.custom-textarea::-webkit-scrollbar-track {
  background: #f1f1f1; /* Set the color of the scrollbar track */
}

  .card-box {
    background-color: #fff;
    /* padding: 1.5rem 0rem 0rem 0rem; */
    -webkit-box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    margin-bottom: 1px;
    border-radius: .25rem;
  }
  
  .col-auto {
    flex: 0 0 auto;
    width: auto;
  }
  
  .nav {
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
  }

  .test2{
    border: 1px solid rgba(0, 0, 0, 0.8);
  }
  
  /* .form-container {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
} */

.md-field {
    /* width: 80%; */
    /* min-height: 48px; */
    margin: 4px 0 24px;
    /* padding-top: 16px; */
    display: flex;
    position: relative;
    font-family: inherit;
}

.form-group {
  margin-bottom: 15px;
}
.md-field.md-theme-demo-light.md-has-textarea:not(.md-autogrow):before {
    border-color: #448aff;
    border-color: #448aff;
}

.md-field.md-has-textarea:not(.md-autogrow):before {
    border-width: 2px;
}

.md-field.md-has-textarea:not(.md-autogrow):after, .md-field.md-has-textarea:not(.md-autogrow):before {
    height: auto;
    pointer-events: none;
    top: 0;
    bottom: 0;
    transform: none;
    background: 0 0 !important;
    border: 1px solid transparent;
    border-radius: 3px;
}

.md-field.md-has-textarea:not(.md-autogrow) label {
    left: 30;
}

*, :after, :before {
    box-sizing: inherit;
}

.md-field:before {
    height: 2px;
    z-index: 2;
    opacity: 0;
    transform: scaleX(.12);
}

.md-field .md-input, .md-field .md-textarea {
    height: 36px;
    padding: 7px 0;
    font-size: 14px !important;
    -webkit-text-fill-color: #000000 !important;
}

.md-field.md-has-textarea:not(.md-autogrow).md-focused .md-textarea, .md-field.md-has-textarea:not(.md-autogrow).md-has-value .md-textarea {
    padding-top: 0px;
}
textarea {
            display: block;
            margin-bottom: 20px;
        }
        .textarea {
            display: block;
            margin-bottom: 20px;
            width: 100%; /* Take the full width */
            padding: 10px; /* Some padding for comfort */
            box-sizing: border-box; /* To ensure padding doesn't affect overall width */
            border: 1px solid #ccc; /* Basic border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Readable text size */
            resize: vertical; /* Allow vertical resizing, but not horizontal */
            transition: border-color 0.3s ease; /* Smooth transition for border color */
        }
        .textarea:focus {
            border-color: #007BFF; /* Highlight with a color when focused */
            outline: none; /* Remove the default outline */
        }

/* textarea {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 400px; /* Adjust as needed 
    height:200px;
    border-radius:3%;
} */
.md-card-content{
    display:flex;
    flex-direction:column;
    
}


label {
  display: block;
  margin-bottom: 5px;
}

/* input[type="text"],
input[type="password"],
input[type="email"],
select {
   width: 100%; 
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
} */

.input-group {
  display: flex;
}

/* .input-group input {
  flex: 1;
} */

/* .input-group button {
  margin-left: 10px;
  padding: 8px 12px;
  border: 1px solid #007bff;
  border-radius: 4px;
  background-color: #fff;
  color: #007bff;
  cursor: pointer;
} */

/* .input-group button:hover {
  background-color: #007bff;
  color: #fff;
} */


button[type="submit"],
button[type="button"].cancel-button {
  /* padding: 10px 20px; */
  /* border: none;
  border-radius: 4px; */
  cursor: pointer;
}

/* button[type="submit"].save-button {
  background-color: #28a745;
  color: #fff;
} */

/* button[type="button"].cancel-button {
  background-color: #ccc;
  color: #333;
  margin-left: 10px;
} */

#buttons {
  display: flex;
  flex-direction: row;
  
}

/* button[type="button"].cancel-button:hover {
  background-color: #b3b3b3;
} */

  .nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: rgb(113, 182, 249);
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
  }
  
  .nav-pills .nav-link {
    background: none;
    border: 0;
    border-radius: 0.25rem;
  }
  
  .nav-tabs .nav-link {
    margin-bottom: -1px;
    background: none;
    border: 1px solid transparent;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
  }
  
  ol, ul, dl {
    margin-top: 0;
    margin-bottom: 1rem;
  }

  .create-field{
    display:flex; 
    flex-direction: column; 
    align-items: left;
  }

  .all-buttons {
    display: flex;
    flex-direction: row;
    padding: 5px 10px;
  }

  .row-layout2a{
    display: flex;
    flex-direction: column; 
    align-items: flex-end;
    /* margin-top: 40px; */
  }

  .form-style{
    display:flex;
    flex-direction:column;
    align-items:center;
  }
  </style>