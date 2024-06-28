<template>
    <div>
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

}
</script>

<style>

</style>