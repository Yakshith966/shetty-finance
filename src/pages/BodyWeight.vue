<template>
    <div>
        <md-card>
            <md-card-content>
                <md-card-content>
                    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                            <md-card>
                              <md-card-header data-background-color="green">
                              <h4 class="title">PEN WISE ALLOTMENT OF EXPERIMENTAL GROUP</h4>
                              <!-- <p class="category">List of Users</p> -->
                              </md-card-header>
                                <md-card-content>
                                  <md-table v-model="tempo" :table-header-color="tableHeaderColor">
    <md-table-row slot="md-table-row" slot-scope="{ item, index }">
      <md-table-cell md-label="Trials" :class="{ 'no-bottom-border': index !== tempo.length - 1 }">
        <span >{{ item.Trials }}</span>
  
      </md-table-cell>
      <md-table-cell md-label="T1">
        <span v-if="!item.editing">{{ item.T1 }}</span>
        <input v-else v-model="item.T1" />
      </md-table-cell>
      <md-table-cell md-label="T2">
        <span v-if="!item.editing">{{ item.T2 }}</span>
        <input v-else v-model="item.T2" />
      </md-table-cell>
      <md-table-cell md-label="T3">
        <span v-if="!item.editing">{{ item.T3 }}</span>
        <input v-else v-model="item.T3" />
      </md-table-cell>
      <md-table-cell md-label="T4">
        <span v-if="!item.editing">{{ item.T4 }}</span>
        <input v-else v-model="item.T4" />
      </md-table-cell>
      <md-table-cell md-label="T5">
        <span v-if="!item.editing">{{ item.T5 }}</span>
        <input v-else v-model="item.T5" />
      </md-table-cell>
      <md-table-cell md-label="Trial Counts">
        <span v-if="!item.editing">{{ item.TrialCounts }}</span>
        <input v-else v-model="item.TrialCounts" />
      </md-table-cell>
      <md-table-cell md-label="Replicas">
        <span v-if="!item.editing">{{ item.Replicas }}</span>
        <input v-else v-model="item.Replicas" />
      </md-table-cell>
      <md-table-cell md-label="Action">
        <button @click="toggleEdit(item)">{{ item.editing ? 'Save' : 'Edit' }}</button>
      </md-table-cell>
    </md-table-row>
  </md-table>
                                </md-card-content>
                            </md-card>
                        </div>
                            </md-card-content>
                        </md-card-content>
        </md-card>
        <md-card>
            <md-card-content>
                <md-card-content>
                    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                            <md-card>
                              <md-card-header data-background-color="green">
                              <h4 class="title">Body Weight Details in Grams</h4>
                              <!-- <p class="category">List of Users</p> -->
                              </md-card-header>
                                <md-card-content>
                                  <md-table v-model="BodyWeight" :table-header-color="tableHeaderColor">
                                      <md-table-row slot="md-table-row" slot-scope="{ item }">
                                      <md-table-cell md-label="Age in Days">{{ item.AgeinDays }}</md-table-cell>
                                      <md-table-cell md-label="T1 Group">{{ item.T1 }}</md-table-cell>
                                      <md-table-cell md-label="T2 Group">{{ item.T2}}</md-table-cell>
                                      <md-table-cell md-label="T3 Group">{{ item.T3}}</md-table-cell>
                                      <md-table-cell md-label="T4 Group">{{ item.T4}}</md-table-cell>
                                      <md-table-cell md-label="T5 Group">{{ item.T5}}</md-table-cell>
                                      </md-table-row>
                                  </md-table>
                                </md-card-content>
                            </md-card>
                        </div>
                            </md-card-content>
                        </md-card-content>
        </md-card>



                    <md-card>
            <md-card-content>
    <md-card-content>

        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">Feed Consumption Per Bird (in Grams)</h4>
                <!-- <p class="category">List of Users</p> -->
                </md-card-header>
                <md-card-content>
                  <md-table v-model="BodyWeight" :table-header-color="tableHeaderColor">
                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="Age in Days">{{ item.AgeinDays }}</md-table-cell>
                      <md-table-cell md-label="T1 Group">{{ item.T1 }}</md-table-cell>
                      <md-table-cell md-label="T2 Group">{{ item.T2}}</md-table-cell>
                      <md-table-cell md-label="T3 Group">{{ item.T3}}</md-table-cell>
                      <md-table-cell md-label="T4 Group">{{ item.T4}}</md-table-cell>
                      <md-table-cell md-label="T5 Group">{{ item.T5}}</md-table-cell>
          
                      <!-- <md-table-cell md-label="Access Card"><md-icon>key</md-icon></md-table-cell>
                      <md-table-cell md-label="Status">Active</md-table-cell> -->
                    </md-table-row>
                  </md-table>
                </md-card-content>
                </md-card>
        </div>
                 </md-card-content>
              </md-card-content>
            </md-card>
                    <md-card>
            <md-card-content>
    <md-card-content>

        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">Day Wise FCR</h4>
                <!-- <p class="category">List of Users</p> -->
                </md-card-header>
                <md-card-content>
                  <md-table v-model="BodyWeight" :table-header-color="tableHeaderColor">
                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="Age in Days">{{ item.AgeinDays }}</md-table-cell>
                      <md-table-cell md-label="T1 Group">{{ item.T1 }}</md-table-cell>
                      <md-table-cell md-label="T2 Group">{{ item.T2}}</md-table-cell>
                      <md-table-cell md-label="T3 Group">{{ item.T3}}</md-table-cell>
                      <md-table-cell md-label="T4 Group">{{ item.T4}}</md-table-cell>
                      <md-table-cell md-label="T5 Group">{{ item.T5}}</md-table-cell>
          
                      <!-- <md-table-cell md-label="Access Card"><md-icon>key</md-icon></md-table-cell>
                      <md-table-cell md-label="Status">Active</md-table-cell> -->
                    </md-table-row>
                  </md-table>
                </md-card-content>
                </md-card>
        </div>
                 </md-card-content>
              </md-card-content>
            </md-card>
                    <md-card>
            <md-card-content>
    <md-card-content>

        <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">Day 35 Result Summary</h4>
                <!-- <p class="category">List of Users</p> -->
                </md-card-header>
                <md-card-content>
                  <md-table v-model="Day35Result" :table-header-color="tableHeaderColor">
                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="Parameter">
                      <md-field>
                        <!-- <label>Initial Value (Read Only)</label> -->
                        <md-input v-model="item.AgeinDays" readonly></md-input>
                      </md-field>
                    </md-table-cell>
                      <md-table-cell md-label="T1 Group">
                        <md-field>
                        <!-- <label>Initial Value (Read Only)</label> -->
                        <md-input v-model="item.T1" readonly></md-input>
                      </md-field>
                      </md-table-cell>
                      <md-table-cell md-label="T2 Group">
                        <md-field>
                        <!-- <label>Initial Value (Read Only)</label> -->
                        <md-input v-model="item.T2" readonly></md-input>
                      </md-field>
                      </md-table-cell>
                      <md-table-cell md-label="T3 Group">
                        <md-field>
                        <!-- <label>Initial Value (Read Only)</label> -->
                        <md-input v-model="item.T3" readonly></md-input>
                      </md-field>
                       </md-table-cell>
                      <md-table-cell md-label="T4 Group">
                        <md-field>
                        <!-- <label>Initial Value (Read Only)</label> -->
                        <md-input v-model="item.T4" readonly></md-input>
                      </md-field>
                      </md-table-cell>
                      <md-table-cell md-label="T5 Group">
                        <md-field>
                        <!-- <label>Initial Value (Read Only)</label> -->
                        <md-input v-model="item.T5" readonly></md-input>
                      </md-field>
                      </md-table-cell>
          
                      <!-- <md-table-cell md-label="Access Card"><md-icon>key</md-icon></md-table-cell>
                      <md-table-cell md-label="Status">Active</md-table-cell> -->
                    </md-table-row>
                  </md-table>
                </md-card-content>
                </md-card>
        </div>
                 </md-card-content>
              </md-card-content>
            </md-card>

            
          </div> 

</template>

<script>
export default {
    data(){
        return {
            temp2:[],
            tempo: [
            { Trials: '', T1: 1, T2: 2, T3: 3, T4: 4, T5: 5, TrialCounts: 30, Replicas: 5, editing: false },
        { Trials: '', T1: 6, T2: 7, T3: 8, T4: 9, T5: 10, TrialCounts: 30, Replicas: 5, editing: false },
        { Trials: 'Alloted Pens', T1: 11, T2: 12, T3: 13, T4: 14, T5: 15, TrialCounts: 30, Replicas: 5, editing: false  },
        { Trials: '', T1: 16, T2: 17, T3: 18, T4: 19, T5: 20, TrialCounts: 30, Replicas: 5, editing: false  },
        { Trials: '', T1: 21, T2: 22, T3: 23, T4: 24, T5: 25, TrialCounts: 30, Replicas: 5, editing: false  }
      ],
            BodyWeight:[
                { AgeinDays:"7",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"14",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"21",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"28",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"35",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
            ],
            Day35Result:[
                { AgeinDays:"Bodyweight/Bird",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"Feed Consumed/Bird",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"FCR",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"CFCR",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"Livability",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"BEI",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"Feed Cost/Kg",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
                { AgeinDays:"FD Cost/K.g Live Bird wt",T1:"43.53",T2:"42.93",T3:"43.26",T4:"43.33",T5:"43.13"},
            ]
        };
    },
    methods:{
      toggleEdit(item) {
      if (item.editing) {
        this.saveItem(item);
      }
      item.editing = !item.editing;
    },
    saveItem(item) {
      // Logic to save the item, e.g., API call or state update
      console.log('Item saved:', item);
    },
    }

}
</script>

<style>
.no-bottom-border {
  border-bottom: none;
}

input {
  width: 100%;
}

</style>