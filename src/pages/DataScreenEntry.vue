<template>
  <div>
  <div v-if="chck">
                            <md-card>
                              <md-card-header data-background-color="green">
                              <h4 class="title">Body Weight Details in Grams</h4>
                              <!-- <p class="category">List of Users</p> -->
                              </md-card-header>
                                <md-card-content>
                                  <md-table v-model="bwView" :table-header-color="tableHeaderColor">
                                      <md-table-row slot="md-table-row" slot-scope="{ item }">
                                      <md-table-cell md-label="Age in Days">{{ item.selectVal }}</md-table-cell>
                                      <md-table-cell md-label="T1 Group">{{ item.trailGroup }}</md-table-cell>
                                     
                                      </md-table-row>
                                  </md-table>
                                </md-card-content>
                            </md-card>
  </div>

    <div v-else>
        <div class="card-box">
        <div class="row align-items-center mb-3">
            <div class="col-auto">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('BodyWeight') }]"
                  @click.prevent="setActiveTab('BodyWeight')"
                >
                  Body weight Per Bird(Gms)
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('FeedConsumption') }]"
                  @click.prevent="setActiveTab('FeedConsumption')"
                >
                  Feed Consumption Per Bird (in GMS)
                </a>
              </li>
            </ul>
            </div>
        </div>
        </div>

        <div v-if="activeTab === 'BodyWeight'">     
            <md-card>
                    <md-card-header data-background-color="green">
                    <h4 class="title">BODY WEIGHT PER(GMS)</h4>
                    </md-card-header>

                    <md-card-content>
                      <hr>
                      <div class="table-container">
                        <div class="custm-header">
                            <div class="t-cell">Age in Days/Week</div>
                            <div class="t-cell">Trail Group</div>
                            <div class="t-cell">Pen No</div>
                            <div class="t-cell">No of Birds</div>
                            <div class="t-cell">Body Wt/Bird(Gms)</div>
                            <!-- <div class="t-cell">Body Weight</div> -->
                            <div class="t-cell">Mortality</div>
                            <div class="t-cell">Mortal Bird Wt</div>
                            <div class="t-cell">Leg Weak Bird</div>
                            <div class="t-cell">Leg Weak Bird Wt</div>
                            <div class="t-cell">Male</div>
                            <div class="t-cell">Female</div>
                            <div class="t-cell">Temp</div>
                            <div class="t-cell">Humidity</div>
                            <div class="t-cell">Vaccine Given</div>
                            <div class="t-cell">Medicine Given</div>
                            <!-- <div class="t-cell">Action</div> -->
                        </div>
                        <div v-for="row in BodyWeight" :key="row.id" class="custm-row">
                            <div class="t-cell"> 
                                <select name="cars" v-model="row.selectVal" id="cars" class="select-style">
                                        <option value="1">1</option>
                                        <option value="7">7</option>
                                        <option value="14">14</option>
                                        <option value="21">21</option>
                                        <option value="28">28</option>
                                        <option value="35">35</option>
                                    </select>
                            </div>
                            <div class="t-cell">
                                <select name="cars" v-model="row.trailGroup" id="cars" class="select-style">
                                    <option value="T1">T1</option>
                                    <option value="T2">T2</option>
                                    <option value="T3">T3</option>
                                    <option value="T4">T4</option>
                                    <option value="T5">T5</option>
                                </select>
                              
                            </div>
                            <div class="t-cell">
                                <select name="cars" v-model="row.penNo" id="cars" class="select-style">
                                  <option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>

                                    </select>
                              
                            </div>
                            <div class="t-cell"><input type="number" v-model="row.crateWt" /></div>
                            <div class="t-cell"><input type="number" v-model="row.tareWt" /></div>
                            <div class="t-cell"><input type="number" v-model="row.totalWt" /></div>
                            <div class="t-cell"><input type="number" v-model="row.bodyWt" /></div>
                            <div class="t-cell"><input type="number" v-model="row.mortality" /></div>
                            <div class="t-cell"><input type="number" v-model="row.mortalBird" /></div>
                            <div class="t-cell"><input type="number" v-model="row.male" /></div>
                            <div class="t-cell"><input type="number" v-model="row.female" /></div>
                            <div class="t-cell"><input type="number" v-model="row.temp" /></div>
                            <div class="t-cell"><input type="number" v-model="row.humidity" /></div>
                            <div class="t-cell"><input type="number" v-model="row.vaccineMed" /></div>
                            <div class="t-cell"><input type="number" v-model="row.medicineGiven" /></div>
                            
                            </div>
                      </div>
                      <hr>
                <div class="sec-row">
                    <div><md-button @click="addRowBodyWeight" class="md-primary">Add Row</md-button> </div>
                    <div></div>
                    <div></div>
                          <div><md-button type="submit" @click="displayBw" class="md-success">Submit</md-button></div>
                          <div><md-button type="button" class="md-danger">Reset</md-button></div>
                        </div>
                    
                    </md-card-content>

              <md-card>
                
              
                  <md-card-header data-background-color="green">
                    <h4 class="title">BODY WEIGHT PER(GMS)</h4>
                    </md-card-header>
                    <md-card-content>                                          
                      <table class="styled-table">
        <thead>
            <tr>
                <th class="temp-th">Age in Days/Week</th>
                <th>Trail Group</th>
                <th>Pen No</th>
                <th>No of Birds</th>
                <th>Body Wt/Bird(Gms)</th>
                <th>Mortality</th>
                <!-- <th>Mortality</th> -->
                <!-- <th>Mortal Bird</th> -->
                <th>Mortal Bird Wt</th>
                <th>Leg Weak Bird</th>
                <th>Leg Weak Bird Wt</th>
                <th>Male</th>
                <th>Female</th>
                <th>Temp</th>
                <th>Humidity</th>
                <th>Vaccine Given</th>
                <th>Medicine Given</th>
                <th>Edit</th>
                <!-- <th>Delete</th> -->
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in bwView" :key="item.id">
                <td>
                    <template v-if="!item.isEditing">{{ item.selectVal }}</template>
                    <template v-else>
                      
                                <select name="cars" v-model="item.selectVal" id="cars" class="select-style">
                                        <option value="1">1</option>
                                        <option value="7">7</option>
                                        <option value="14">14</option>
                                        <option value="21">21</option>
                                        <option value="28">28</option>
                                        <option value="35">35</option>
                                    </select>
                            
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.trailGroup }}</template>
                    <template v-else>
                     
                                <select name="cars" v-model="item.trailGroup" id="cars" class="select-style">
                                    <option value="T1">T1</option>
                                    <option value="T2">T2</option>
                                    <option value="T3">T3</option>
                                    <option value="T4">T4</option>
                                    <option value="T5">T5</option>
                                </select>
                              
                            
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.penNo }}</template>
                    <template v-else>
                        
                                <select name="cars" v-model="item.penNo" id="cars" class="select-style">
                                  <option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>

                                    </select>
                              
                            
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.crateWt }}</template>
                    <template v-else>
                        <input v-model="item.crateWt" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.tareWt }}</template>
                    <template v-else>
                        <input v-model="item.tareWt" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.totalWt }}</template>
                    <template v-else>
                        <input v-model="item.tareWt" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.bodyWt }}</template>
                    <template v-else>
                        <input v-model="item.bodyWt" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.mortality }}</template>
                    <template v-else>
                        <input v-model="item.mortality" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.mortalBird }}</template>
                    <template v-else>
                        <input v-model="item.mortalBird" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.male }}</template>
                    <template v-else>
                        <input v-model="item.male" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.female }}</template>
                    <template v-else>
                        <input v-model="item.female" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.temp }}</template>
                    <template v-else>
                        <input v-model="item.temp" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.humidity }}</template>
                    <template v-else>
                        <input v-model="item.humidity" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.vaccineMed }}</template>
                    <template v-else>
                        <input v-model="item.vaccineMed" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.medicineGiven }}</template>
                    <template v-else>
                        <input v-model="item.medicineGiven" class="custm"/>
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
            </tr>
        </tbody>
                      </table>
                    </md-card-content>
              </md-card>
            </md-card>

        </div>

        <div v-if="activeTab === 'FeedConsumption'">     
            <md-card>
                    <md-card-header data-background-color="green">
                    <h4 class="title">FEED CONSUMPTION PER BIRD(GMS)</h4>
                    <!-- <p class="category">List of Users</p> -->
                    </md-card-header>
                    <md-card-content>
                      
                    <!-- <div class="table-layout">

                      </div> -->
                      <hr>
                      
                      <div class="table-container">
                        <div class="custm-header">
                            <div class="t-cell">Age in Days/Week</div>
                            <div class="t-cell">Trail Group</div>
                            <div class="t-cell">Pen Number</div>
                            <div class="t-cell">No of Birds</div>
                            <div class="t-cell">Alloted Feed(Gms)</div>
                            <div class="t-cell">Consumed Feed(in Gms)</div>
                            <div class="t-cell">Feed Consumed Per Bird(Gms)</div>
                            <!-- <div class="t-cell">Action</div> -->
                        </div>
                        <div v-for="row in FeedConsumption" :key="row.id" class="custm-row">
                            <div class="t-cell"> 
                                <select name="cars" v-model="row.ageDays" id="cars" class="select-style">
                                  <option value="1">1</option>
                                  <option value="7">7</option>
                                        <option value="14">14</option>
                                        <option value="21">21</option>
                                        <option value="28">28</option>
                                        <option value="35">35</option>
                                    </select>
                            </div>
                            <div class="t-cell">
                                <select name="cars" v-model="row.feedTrailGroup" id="cars" class="select-style">
                                  <option value="T1">T1</option>
                                    <option value="T2">T2</option>
                                    <option value="T3">T3</option>
                                    <option value="T4">T4</option>
                                    <option value="T5">T5</option>
                                </select>
                              
                            </div>
                            <div class="t-cell">
                                <select name="cars" v-model="row.feedPenNo" id="cars" class="select-style">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                  <option value="13">13</option>
                                  <option value="14">14</option>
                                  <option value="15">15</option>
                                  <option value="16">16</option>
                                  <option value="17">17</option>
                                  <option value="18">18</option>
                                  <option value="19">19</option>
                                  <option value="20">20</option>
                                  <option value="21">21</option>
                                  <option value="22">22</option>
                                  <option value="23">23</option>
                                  <option value="24">24</option>
                                  <option value="25">25</option>
                                    </select>
                              
                            </div>
                            <div class="t-cell"><input type="number" v-model="row.noBirds" /></div>
                            <div class="t-cell"><input type="number" v-model="row.feedAlloted" /></div>
                            <div class="t-cell"><input type="number" v-model="row.feedConsumed" /></div>
                            <div class="t-cell"><input type="number" v-model="row.feedConsumedPerBird" /></div>
                            
                            </div>
                      </div>
                      <hr>
                      <div class="sec-row">
                        
                    <div><md-button @click="addRowFeedConsumption" class="md-primary">Add Row</md-button> </div>
                    <div></div>
                    <div></div>
                          <div><md-button type="submit" @click="displayCf" class="md-success">Submit</md-button></div>
                          <div><md-button type="button" class="md-danger">Reset</md-button></div>
                        </div>
                     

    </md-card-content>
              <md-card>
                
               
                  <md-card-header data-background-color="green">
                    <h4 class="title">FEED CONSUMPTION PER BIRD(GMS)</h4>
                    <!-- <p class="category">List of Users</p> -->
                </md-card-header>
             
                    <md-card-content>     
                            
<table class="styled-table">
        <thead>
            <tr>
                <th>Age in Days/Week</th>
                <th>Trail Group</th>
                <th>Pen Number</th>
                <th>No of Birds</th>
                <th>Alloted Feed(Gms)</th>
                <th>Consumed Feed(in Gms)</th>
                <th>Feed Consumed Per Bird(Gms)</th>
                <th>Action</th>
                <!-- <th>Delete</th> -->
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in fcView" :key="item.id">
                <td>
                    <template v-if="!item.isEditing">{{ item.ageDays }}</template>
                    <template v-else>
                        <select v-model="item.ageDays" class="slct2">
                          <option value="1">1</option>
                          <option value="7">7</option>
                                        <option value="14">14</option>
                                        <option value="21">21</option>
                                        <option value="28">28</option>
                                        <option value="35">35</option>
                        </select>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.feedTrailGroup }}</template>
                    <template v-else>
                        <select v-model="item.feedTrailGroup" class="slct2">
                          <option value="T1">T1</option>
                                    <option value="T2">T2</option>
                                    <option value="T3">T3</option>
                                    <option value="T4">T4</option>
                                    <option value="T5">T5</option>
                        </select>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.feedPenNo }}</template>
                    <template v-else>
                        <select v-model="item.feedPenNo" class="slct2">
                          <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                  <option value="13">13</option>
                                  <option value="14">14</option>
                                  <option value="15">15</option>
                                  <option value="16">16</option>
                                  <option value="17">17</option>
                                  <option value="18">18</option>
                                  <option value="19">19</option>
                                  <option value="20">20</option>
                                  <option value="21">21</option>
                                  <option value="22">22</option>
                                  <option value="23">23</option>
                                  <option value="24">24</option>
                                  <option value="25">25</option>
                        </select>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.noBirds }}</template>
                    <template v-else>
                        <input v-model="item.noBirds" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.feedAlloted }}</template>
                    <template v-else>
                        <input v-model="item.feedAlloted" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.feedConsumed  }}</template>
                    <template v-else>
                        <input v-model="item.feedConsumed" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.feedConsumedPerBird }}</template>
                    <template v-else>
                        <input v-model="item.feedConsumedPerBird" class="custm"/>
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
            </md-card>

        </div>
        
       
          
    </div>

    <div class="row-layout2">
                <div id="buttons" v-if="!chck">
                        <div>
                            <md-button type="submit" class="md-success">Submit</md-button>
                        </div>
                        
                        <div style="padding-left: 10px;" @click="result">
                            <md-button type="button" class="md-danger">Calculate Day wise Result</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                            <md-button type="button" class="md-danger">Calculate Day wise FCR</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                            <md-button type="button" class="md-danger">Calculate Day 35 Result</md-button>
                        </div>
                </div>
                <div v-else>
                    <div @click="result">
                        <md-button type="submit" class="md-success">Back</md-button>
                    </div>
                </div>
    </div> 
  </div>
</template>
<script>
    let id1 = 0;
    let id2 = 0;
   

export default{
    data(){
        return{
          chck:false,
          bwView:[],
          fcView:[],
            activeTabMain: 'view',
            activeTab: 'FeedConsumption',
            temp2:[],
            tempBodyWeight:[
            { AgeinDays:"7",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"14",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"21",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"28",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"35",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
            ],
            BodyWeight: [
          { selectVal:'',trailGroup:'',penNo:'',crateWt:'',tareWt:'',totalWt:'',bodyWt:'',mortality:'',mortalBird:'',male:'',female:'',temp:'',humidity:'',vaccineMed:'',medicineGiven:'',isEditing: false, id: id1}
        ],
        
            FeedConsumption: [
          { ageDays:'',feedTrailGroup:'',feedPenNo:'',noBirds:'',feedAlloted:'',feedConsumed:'',feedConsumedPerBird:'',isEditing: false, id: id2++}
        ],
        }
    },
methods:{
    isActive(tab) {
        return this.activeTab === tab;
      },
      setActiveTab(tab) {
        this.activeTab = tab;
      },
    isActiveMain(tab) {
        return this.activeTab === tab;
      },
      setActiveTabMain(tab) {
        this.activeTab = tab;
      },
      toggleEdit(item) {
        item.isEditing = !item.isEditing;
      },
      saveChanges(item) {
        item.isEditing = false;
        // Additional logic to save changes if needed
      },
    addRowBodyWeight(){
        this.BodyWeight.push({selectVal:'',trailGroup:'',penNo:'',crateWt:'',tareWt:'',totalWt:'',bodyWt:'',mortality:'',mortalBird:'',male:'',female:'',temp:'',humidity:'',vaccineMed:'',medicineGiven:'',isEditing: false, id: Date.now() + Math.random()});
        console.log("BodyWeight",this.BodyWeight);
    },
    addRowFeedConsumption(){
        this.FeedConsumption.push({ ageDays:'',feedTrailGroup:'',feedPenNo:'',noBirds:'',feedAlloted:'',feedConsumed:'',feedConsumedPerBird:'',isEditing: false, id: Date.now() + Math.random()});
        console.log("FeedConsumption",this.FeedConsumption);
    },
    result(){
      this.chck=!this.chck;
    },
    // backin(){
    //   this.chck=!this.chck;
    // },
    clear(){
        this.selectVal='';
        this.trailGroup='';
        this.penNo='';
    },
    displayBw(){
        // this.bwView=[];
        this.bwView.push(...this.BodyWeight);
        this.BodyWeight=[{
          selectVal: '',
          trailGroup: '',
          penNo: '',
        crateWt: '',
        tareWt: '',
        totalWt: '',
        bodyWt: '',
        mortality: '',
        mortalBird: '',
        male: '',
        female: '',
        temp: '',
        humidity: '',
        vaccineMed: '',
        isEditing: false,
        id:0,
      }];
      this.clearBodyWeightInputs();
      console.log(this.bwView);
      console.log("hippi");
    },
    clearBodyWeightInputs() {
      this.BodyWeight = this.BodyWeight.map(item => ({
        selectVal: '',
        trailGroup: '',
        penNo: '',
        crateWt: '',
        tareWt: '',
        totalWt: '',
        bodyWt: '',
        mortality: '',
        mortalBird: '',
        male: '',
        female: '',
        temp: '',
        humidity: '',
        vaccineMed: '',
        isEditing: false,
        id:Date.now() + Math.random(),
      }));
    },
    displayCf(){
      this.fcView.push(...this.FeedConsumption);
        this.FeedConsumption=[{
          ageDays: '',
          feedTrailGroup: '',
          feedPenNo: '',
        noBirds: '',
        feedAlloted: '',
        feedConsumed: '',
        feedConsumedPerBird: '',
        isEditing: false,
        id:0,
      }];
      this.clearFcInputs();
        // this.fcView=[];
        // this.fcView.push(...this.FeedConsumption);
        console.log(this.fcView);
    },
    clearFcInputs(){
    this.BodyWeight = this.BodyWeight.map(item => ({
        ageDays: '',
          feedTrailGroup: '',
          feedPenNo: '',
        noBirds: '',
        feedAlloted: '',
        feedConsumed: '',
        feedConsumedPerBird: '',
        isEditing: false,
        id:Date.now() + Math.random(),
      }));
    },
    removeBodyWeightRow(row) {
      this.bwView = this.bwView.filter((r) => r.id !== row.id);
    },
    removeFeedRow(row) {
      this.FeedConsumption = this.FeedConsumption.filter((r) => r !== row);
    },
},
watch:{
  bwView: {
      handler(newValue, oldValue) {
        // This function will run every time bwView changes
        console.log('bwView changed:', newValue);
        // You can perform any additional actions or logic here
      },
      deep: true, // This is optional but useful if bwView is an array or object
    }
}
};
</script>

<style>
.table-container {
  display: flex;
  flex-direction: column;
  width: 100%;
  border-collapse: collapse;
}

.custm-header,
.custm-row {
  display: flex;
}

.t-cell {
  flex: 1;
  /* padding: 8px; */
  border: 1px solid #ddd;
  box-sizing: border-box;
  text-align: center;
}

.custm-header {
  background-color: #f5f5f5;
  font-weight: bold;
}

.select-style,
input[type='number'] {
  width: 100%; /* Adjust this to change the width */
  height: 40px; /* Adjust this to change the height */
  padding: 8px; /* Adjust this for inner padding */
  box-sizing: border-box;
  font-size: 16px; /* Adjust this for font size */
}


.custm-row {
  background-color: #fff;
}

.t-cell:last-child {
  border-right: none;
}

.select-style {
  width: 100%;
  padding: 4px;
  box-sizing: border-box;
}

input[type='number'] {
  width: 100%;
  padding: 4px;
  box-sizing: border-box;
}

.table-cell {
  /* flex: 1; */
  padding: 8px;
  border: 1px solid #ddd;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
}
.styled-table td {
    /* padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    width: auto; */

    /* padding: 12px 15px; */
    border: 1px solid #dddddd;
    /* width: 100%; */
    height: 40px;
    /* padding: 8px; */
    /* box-sizing: border-box; */
    font-size: 18px;

}
.styled-table th {
  font-size: 14px;
    background-color: #f2f2f2;
}
.styled-table .slct, .styled-table .custm {
    width: 100%;
    box-sizing: border-box;
}

/* .table-cell input,
.table-cell .md-select,
.table-cell .md-field {
  width: 100%;
} */

 .col-auto {
    flex: 0 0 auto;
    flex-direction: row;
    width: auto;
  }
  .card-box {
    background-color: #fff;
    padding: 10px;
    -webkit-box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    /* margin-bottom: 1px; */
    border-radius: .25rem;
  }

  .align-items-center {
    align-items: center !important;
    padding:0px 65px 0px 20px;
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
  .row-layout2{
    display: flex;
    flex-direction: column; 
    align-items: flex-end;
    margin-right: 2%;
  }

  #buttons {
  display: flex;
  flex-direction: row;
  padding-top: 10px;
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: #71b6f9 !important;
  }

  .nav-pills .nav-link {
    background: none;
    border: 0;
    border-radius: 0.25rem;
  }


.struct{
    display: grid;
    grid-template-columns: 105px 140px 58px 200px;
    grid-gap: 25px;
    /* grid-auto-rows: 50px;  */
    /*grid-auto-rows: 50px;  Set all rows to 50px height */
}

.sec-row{
  display: grid;
    grid-template-columns: 135px 690px 58px 90px 100px;
    grid-gap: 25px;
    grid-auto-rows: 50px;
    margin-left:20px; 
}

/* .md-field {
  margin: 0px 0px;
} */

.grid-item {
    height: 50px;
}

/* .test1, .test2, .test3, .test4, .test5 {
  flex: 1; /* Adjust the flex-grow as needed 
} */

/* Ensure that each test class has some default width */
.test1 {
    text-align: right;
    /* grid-column: 1 / 5; */
}
.test3 {
    text-align: right;
    /* grid-column: 3 / 5; */
}
/* .test4 {
    grid-column: 4 / 5;
}
.test5 {
    grid-column: 5 / 5;
} */

.testing{
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  padding-top: 15px;
  padding-left: 20px;
  justify-content: space-between;
  gap: 20px; /* Add gap between flex items */

}

hr {
            border: none;
            height: 2px;
            background-color: #000;
            /* margin-top: 5px; */
        }

.custom-md-field{
  /* Adjust the overall size of the md-field if needed */
  width: 190px; /* Adjust as needed */
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
  
  /* .mb-3 {
    margin-bottom: 1.5rem !important;
  } */
  
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
  
  .card-box {
    background-color: #fff;
    padding: 10px;
    -webkit-box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    /* margin-bottom: 1px; */
    border-radius: .25rem;
  }
  
  .table-container {
  width: 100%;
  overflow-x: auto;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.table-header,
.table-row {
  display: flex;
  width: 2200px; /* Adjust this value based on the number of columns */
}

.table-cell {
  flex: 1;
  padding: 8px;
  border: 1px solid #ddd;
  box-sizing: border-box;
}

.table-header {
  background-color: #f5f5f5;
  font-weight: bold;
}

.table-cell select,
.table-cell input {
  width: 100%;
  padding: 4px;
  box-sizing: border-box;
}

.table-cell .slct {
  width: 100%;
}

  
  .col-auto {
    flex: 0 0 auto;
    flex-direction: row;
    width: auto;
  }
  
  .nav {
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
  }

  .styled-table {
  width: 100%;
  border-collapse: collapse;
  /* margin: 25px 0; */
  font-size: 15px;
  font-weight: 500;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  min-width: 400px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
  /* background-color: #009879; */
  /* color: #ffffff; */
  text-align: left;
}

.styled-table th,
.styled-table td {
  padding: 12px 15px;
  border: 1px solid #dddddd;
}

.temp-th{
  padding:0px 0px;
}

.styled-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.styled-table tbody tr:hover {
  background-color: #f1f1f1;
}

.styled-table td button {
  background: none;
  border: none;
  cursor: pointer;
}

.styled-table td button:focus {
  outline: none;
}
 
.slct2{
    height:40px;
    width:130px;
}
  /* .form-container {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
} */

.form-group {
  margin-bottom: 15px;
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
  padding-top: 10px;
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

  .md-list-item .md-list-item-container .md-ripple > span {
    border-radius: 3px;
    display: contents;
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

  .table-layout {
    display: flex;
    flex-direction: column;
   
  }

  .form-style{
    display:flex;
    flex-direction:column;
    align-items:center;
    padding-top:20px;
  }
  
  .row-layout {
    display: flex;
    flex-direction: row;
    align-items: center;
  }
  
  .row-layout1{
    display: flex;
    flex-direction: row; 
    align-items: flex-start;
  }
  
  .row-layout2{
    display: flex;
    flex-direction: column; 
    align-items: flex-end;
    margin-right: 10%;
  }

  .checkbox-select {
  width: 100%;
  height: auto;
  border-radius: 1rem;
}
.checkbox-select__trigger {
  justify-content: space-between;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  background: #fff;
  position: relative;
  z-index: 100;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  display: flex;
  align-items: center;
  cursor: pointer;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  user-select: none;
}
.checkbox-select__trigger.isActive {
  border-radius: 10px 10px 0 0;
  background: #f2f2f2;
}
.checkbox-select__trigger:hover {
  background: #f4f4f4;
}
.checkbox-select__dropdown {
  display: none;
  background: #fff;
  box-shadow: 0 12px 15px 6px rgba(0, 0, 0, 0.1);
  border-radius: 0 0 8px 8px;
  overflow: hidden;
  /* padding-bottom: 25px; */
}
.checkbox-select__dropdown {
  display: block; /* Ensure it gets shown */
}
.checkbox-select__search-wrapp {
  padding: 10px 25px 5px;
}
.checkbox-select__search-wrapp input {
  width: 100%;
  height: 40px;
  border-width: 0 0 2px;
  border-style: solid;
  border-color: #000;
  font-size: 16px;
  background: transparent;
}
.checkbox-select__col {
  display: flex;
  font-size: 12px;
  padding: 0 25px;
  justify-content: space-between;
  text-transform: uppercase;
}
.checkbox-select__select-all label {

  cursor: pointer;
}
.checkbox-select__filters-wrapp {
  /* margin-top: 20px; */
  height: 157px;
  overflow-y: auto;
  padding-left: 0px;
}
.checkbox-select__check-wrapp {
  position: relative;
  padding: 0 25px;
  margin-bottom: 5px;
}
.checkbox-select__check-wrapp input[type="checkbox"] {
  display: none;
}
.checkbox-select__check-wrapp input[type="checkbox"]+label {
  position: relative;
  cursor: pointer;
  font-size: 16px;
  line-height: 22px;
  padding-left: 30px;
  display: inline-block;
  user-select: none;
  transition: padding 0.25s ease;
}
.checkbox-select__check-wrapp input[type="checkbox"]+label:after {
  border: solid 2px #000;
  content: "";
  width: 22px;
  height: 22px;
  top: 0;
  left: 0;
  position: absolute;
}
.checkbox-select__check-wrapp input[type="checkbox"]+label:before {
  width: 14px;
  height: 14px;
  content: "";
  position: absolute;
  top: 4px;
  left: 4px;
  background-color: #000;
  opacity: 0;
  transform: scale(0.5);
  transition: all 0.2s ease;
}
.checkbox-select__check-wrapp input[type="checkbox"]:checked+label:before {
  opacity: 1;
  transform: scale(1);
}
.col-md-3 {
    flex: 0 0 auto;
    /* width: 25%; */
  }

</style>