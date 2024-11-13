<template>
    <div>
      <div class="">

        <div class="row align-items-center mb-3">
          <div class="col">
            <h4 class="mt-0 header-title"><span class="md-body-2"></span></h4>
            <p class="text-muted font-14 mb-0">trails</p>
          </div>
          
          <div class="">
          <div class="col-auto">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('list') }]"
                  @click.prevent="setActiveTab('list')"
                >
                  List
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('apply') }]"
                  @click.prevent="setActiveTab('apply')"
                >
                  Create
                </a>
              </li>
            </ul>
          </div>
          </div>
        </div>
      </div>

        <div v-if="activeTab === 'list'">
          <div class="row align-items-center mb-3">
              <div class="col">          
                <md-field class="custom-md-field">
                <!-- <label for="movie">show</label> -->
                
                  <label for="country">Show</label>
                  <md-select v-model="country" name="country" id="country" md-dense>
                    <md-option value="australia">5</md-option>
                    <md-option value="brazil">10</md-option>
                    <md-option value="japan">15</md-option>
                    <md-option value="all">All</md-option>
                  </md-select>
        
                </md-field>
              </div>
                <md-field class="custom-md-field" style="margin:0px 0px 0px 0px">
                  <label>Search...</label>
                  <md-input></md-input>
                </md-field>
                <md-icon>search</md-icon>
          </div>
      
          <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">Formula By Using Concentrate</h4>
                <!-- <p class="category">List of Users</p> -->
                </md-card-header>
                <md-card-content>
                  <table class="styled-tablex">
        <thead>
            <tr class="first-option">
                <th>Sl No</th>
                <th>Ingredients</th>
                <th>Pre Starter</th>
                <th>Starter</th>
                <th>Finisher</th>
                <th>Action</th>
                <!-- <th>Delete</th> -->
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in temp" :key="item.id">
                <td>
                    {{ item.slNo }}
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.ingredients }}</template>
                    <template v-else>
                        <select v-model="item.ingredients" class="slct2">
                            <option value="Soya">Soya</option>
                            <option value="Maize">Maize</option>
                            <option value="7.5StarterPremix">7.5 Starter Premix</option>
                            <option value="OIL">OIL</option>
                        </select>
                    </template>
                </td>
               
                <td>
                    <template v-if="!item.isEditing">{{ item.prestarter }}</template>
                    <template v-else>
                        <input v-model="item.prestarter" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.starter }}</template>
                    <template v-else>
                        <input v-model="item.starter" class="custm"/>
                    </template>
                </td>
                <td>
                    <template v-if="!item.isEditing">{{ item.finisher  }}</template>
                    <template v-else>
                        <input v-model="item.finisher" class="custm"/>
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
      </div>
        </div>  

      <div v-if="activeTab === 'apply'">
        <form class="form-style">
          <div style="max-width:75%">
            <md-card max-width="60%">
              <md-card-header data-background-color="green">
                        <h4 class="title">Feed Formula using Concentrate</h4>

              </md-card-header>
              <md-card-content>
        
              <md-card-content>
                <div class="table-layout">

<div class="struct" id="struct">
<label for="country" class="test1"><span class="md-body-2">Trial Number</span></label>

    <div class="test2">
      <md-field>
        <!-- <label for="country">Select</label> -->
        <!-- <md-field> -->
                        <md-input v-model="initial" readonly></md-input>
                    <!-- </md-field> -->
      </md-field>
    </div>

    <div class="test3"></div>
    <div class="test4"></div>

    <label for="country" class="test1"><span class="md-body-2">Start Date</span></label>

    <div class="test2">
      <md-datepicker v-model="selectedDate">
        <label>Select date</label>
      </md-datepicker>
    </div>
    
    <label for="country" class="test3"><span class="md-body-2">End Date</span></label>

    <div class="test4">
      <md-datepicker v-model="selectedDate">
        <label>Select date</label>
      </md-datepicker>
    </div>

    <label for="country" class="test1"><span class="md-body-2">Select Chick Category</span></label>
    <div class="test2">
      <md-field>
        <label for="country">Select</label>
        <md-select required v-model="country" name="country" id="country" md-dense>
          <md-option value="australia">Pre Starter</md-option>
          <md-option value="brazil">Starter</md-option>
          <md-option value="japan">Finisher</md-option>
          <!-- <md-option value="united-states">United States</md-option> -->
        </md-select>
      </md-field>
    </div>
    <!-- <label for="country" class="test1"><span class="md-body-2">Select</span></label> -->
    <!-- <div>
      
      <div class="col-md-3">
    <label><span class="md-body-2">Pens</span></label>
      <div class="w-100">
        <div
          class="checkbox-select__trigger"
          :class="{ isActive: isDropdownOpen }"
          @click="toggleDropdown"
        >
          <span style="font-size: 0.9rem;">Select the applicable</span>
          <i :class="dropdownIconClass"></i>
        </div>
        <div
          id="div"
          class="checkbox-select__dropdown"
          v-show="isDropdownOpen"
        >
          <div class="checkbox-select__search-wrapp">
            <input
              type="text"
              placeholder="Search"
              v-model="searchQuery"
            />
          </div>
          <div class="checkbox-select__col">
            <div class="checkbox-select__select-all">
              <input
              id="divselectAll"
              type="checkbox"
              @change="toggleSelectAll"
              :checked="allSelected"
              />
              <label for="divselectAll">Select All</label>
            </div>
            <div class="checkbox-select__info">
              {{ selectedItems.length }} SELECTED
            </div>
          </div>
          <ul
            id="customScroll"
            class="checkbox-select__filters-wrapp"
            data-simplebar-auto-hide="false"
          >
            <li
              v-for="(option, index) in filteredOptions"
              :key="index"
              style="list-style: none;"
            >
              <div class="checkbox-select__check-wrapp">
                <input
                  :id="'div' + index"
                  class="conditions-check"
                  type="checkbox"
                  :value="option"
                  v-model="selectedItems"
                />
                <label :for="'div' + index" class="text-capitalize">
                  {{ option }}
                </label>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div> -->
</div>
</div>
                <div class="table-layout">

                    <div class="struct">
         <!-- <label for="country" class="test1"><span class="md-body-2">Select Chick Category</span></label> -->
                    <!-- <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label> -->

                    <!-- <div class="test2">
                      <md-field>
                        <label for="country">Select</label>
                        <md-select required v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">T10/10/22</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div> -->
                <!-- <label class="test1" for="country"><span >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trial Number&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                    <div class="test2">
                      <md-field >
                        <label for="country" >Select</label>
                        <md-select required v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">T10/10/22</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div> -->
                    <!-- <label for="country" class="test3"><span class="md-body-2">Trial Group</span></label> -->
                    <!-- <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label> -->

                    <!-- <div class="test4">
                      <md-field>
                        <label for="country">Select</label>
                        <md-select required v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">T10/10/22</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div> -->

                    <!-- <div class="test5"></div> -->

                    <!-- <label for="country" class="test1"><span class="md-body-2">Select</span></label> -->
                    <!-- <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label> -->

                    <!-- <div class="test2">
                      <md-field>
                        <label for="country">Pens</label>
                        <md-select required v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">T10/10/22</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div>
                     -->
                    <!-- <label for="country" class="test3"><span class="md-body-2">Penwise Bird Count</span></label> -->

                    <!-- <div class="test4">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div> -->
                    <!-- <div class="test5"></div> -->

                    <!-- <div class="test1"></div> -->
                    <!-- <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                    <!-- <div class="test2">
                      
                    </div> -->
                    <!-- <label for="country" class="test3"><span class="md-body-2">Feed Per Chick(gm)</span></label> -->

                    <!-- <div class="test4">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div> -->
                    <!-- <div class="test5"></div> -->
                    <!-- <div></div>
                    <div></div>
                    <label for="country" class="test3"><span class="md-body-2">Feed Per Pen(kg)</span></label>

                    <div class="test4">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div> -->
                

                    <!-- <label class="test1" for="country"><span class="md-body-2">Select Ingredients 1</span></label>
                    <div class="test2">
                      <md-field >
                        <label for="country" >Select</label>
                        <md-select required v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">T10/10/22</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div> -->
           
                   <!-- <label for="country" class="test3"><span class="md-body-2">+Qty</span></label>
                    <div class="test4">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div>
                    <div>
                      
                      <md-field class="test5">
                        <label>Select</label>
                        <md-select v-model="font" name="font" id="font" md-dense>
                          <md-option value="arial">GMS</md-option>
                          <md-option value="calibri">MGMS</md-option>
                          <md-option value="cambria">Cambria</md-option>
                        </md-select>
                      </md-field>
                    </div> -->

                    
                    <!-- <label class="test1" for="country"><span class="md-body-2">Trial Number</span></label> -->
                    <!-- <div class="test2">
                      <md-field >
                        <label for="country" >Select</label>
                        <md-select required v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">T10/10/22</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div> -->
        
                  <!-- <label for="country" class="test3"><span class="md-body-2">+Qty</span></label> -->
                    <!-- <div class="test4">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div>
                    <div>
                      
                      <md-field class="test5">
                        <label>Select</label>
                        <md-select v-model="font" name="font" id="font" md-dense>
                          <md-option value="arial">GMS</md-option>
                          <md-option value="calibri">MGMS</md-option>
                          <md-option value="cambria">Cambria</md-option>
                        </md-select>
                      </md-field>
                    </div>
                 

                    <div class="test1"></div>
                    <div class="test2"></div>
                    <label for="country" class="test3"><span class="md-body-2">Total</span></label>
                    <div class="test4">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div> -->

                    <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                    <!-- <div class="test5">
                      
                      <md-field>
                        <label for="font">Select</label>
                        <md-select v-model="font" name="font" id="font" md-dense>
                          <md-option value="arial">GMS</md-option>
                          <md-option value="calibri">GMS</md-option>
                          <md-option value="cambria">Cambria</md-option>
                        </md-select>
                      </md-field>
                  </div> -->
                  <!-- <div class="test1"></div>
                  <div class="test2"></div>
                  <div class="test3"></div>
                  <div class="test4">
                <md-button type="submit" class="md-success" >Submit</md-button>
              </div>
              <div class="test5">
                <md-button type="button" class="md-danger">Cancel</md-button>
              </div> -->
 
            <!-- </div> -->

                  <!-- <div class="row-layout1">
                    <div style="display: flex;flex-direction: row;align-items: center;">
                      <label for="country"><span class="md-body-2">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                    <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div>
                      <md-field>
                        <label for="country">Select</label>
                        <md-select required v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">Pre Starter</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div>
                  </div>
                  </div> -->

                  <!-- <div class="row-layout">

                    <label for="country"><span class="md-body-2">Select Chick Category:&nbsp;&nbsp;</span></label>
                    
                    <div>
                      <md-field>
                        <label for="country">Select</label>
                        <md-select v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">Soya</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div> -->

                    <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                    <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                    
                    <div>
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div> -->

                        <!-- <label for="country" class="test1"><span class="md-body-2">Select Ingredients 1</span></label>
                        <div class="test2">
                        
                          <md-field>
                              <label for="font">Select</label>
                              <md-select v-model="font" name="font" id="font" md-dense>
                              <md-option value="arial">T1</md-option>
                              <md-option value="calibri">T2</md-option>
                              <md-option value="cambria">T3</md-option>
                              </md-select>
                          </md-field>
                        </div>

                    </div>
                  <div class="row-layout">

                    <label for="country"><span class="md-body-2">Select Chick Category:&nbsp;&nbsp;</span></label> -->
                    
                    <!-- <div>
                      <md-field>
                        <label for="country">Select</label>
                        <md-select v-model="country" name="country" id="country" md-dense>
                          <md-option value="australia">Soya</md-option>
                          <md-option value="brazil">Bean</md-option>
                          <md-option value="japan">Japan</md-option>
                          <md-option value="united-states">United States</md-option>
                        </md-select>
                      </md-field>
                    </div> -->

                    <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                    <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                    
                    <div>
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div> -->

                        <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;Trail Group&nbsp;&nbsp;</span></label>
                        <div>
                        
                          <md-field>
                              <label for="font">Select</label>
                              <md-select v-model="font" name="font" id="font" md-dense>
                              <md-option value="arial">T1</md-option>
                              <md-option value="calibri">T2</md-option>
                              <md-option value="cambria">T3</md-option>
                              </md-select>
                          </md-field>
                        </div> -->

                    <!-- </div> -->
              
                  <!-- <div>

                    <label for="country"><span class="md-body-2">Select&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                    
                    <div class="">
                      <md-field>
                        <label for="movies">Movies</label>
                        <md-select v-model="movies" name="movies" id="movies" md-dense multiple>
                          <md-option value="fight-club">Fight Club</md-option>
                          <md-option value="godfather">Godfather</md-option>
                          <md-option value="godfather-ii">Godfather II</md-option>
                          <md-option value="godfather-iii">Godfather III</md-option>
                          <md-option value="godfellas">Godfellas</md-option>
                          <md-option value="pulp-fiction">Pulp Fiction</md-option>
                          <md-option value="scarface">Scarface</md-option>
                        </md-select>
                      </md-field>
                    </div>

                    <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                    
                    <div>
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div>

                
                    

                  </div> -->

                  <!-- <div class="row-layout2">
                   
                   <div style="display: flex;flex-direction: row;align-items: center;"> -->
                     <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                     <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;</span></label> -->
                   <!-- <div>
                     <md-field>
                       <label>Quantity</label>
                       <md-input v-model="number" type="number"></md-input>
                     </md-field>
                   </div> -->

                 <!-- </div>

                  </div>
                  <div class="row-layout2">
                    
                    <div style="display: flex;flex-direction: row;align-items: center;"> -->
                      <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                      <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                    <div>
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="number" type="number"></md-input>
                      </md-field>
                    </div>

                  </div> -->

                  <!-- </div>

                      <div class="row-layout">

                        <label for="country"><span class="md-body-2">Select Ingredients 1&nbsp;&nbsp;&nbsp;&nbsp;</span></label>

                        <div>
                          <md-field>
                            <label for="country">Select</label>
                            <md-select v-model="country" name="country" id="country" md-dense>
                              <md-option value="australia">OIL</md-option>
                              <md-option value="brazil">Bean</md-option>
                              <md-option value="japan">Japan</md-option>
                              <md-option value="united-states">United States</md-option>
                            </md-select>
                          </md-field>
                        </div> -->

                        <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                        <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</span></label>

                        <div>
                          <md-field>
                            <label>Quantity</label>
                            <md-input v-model="number" type="number"></md-input>
                          </md-field>
                        </div>

                        <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <div style="width: 14%;">                     
                          <md-field>
                            <label for="font">Select</label>
                            <md-select v-model="font" name="font" id="font" md-dense>
                              <md-option value="arial">GMS</md-option>
                              <md-option value="calibri">MGMS</md-option>
                              <md-option value="cambria">Cambria</md-option>
                            </md-select>
                          </md-field>
                        </div> -->

                        <!-- </div>
                      <div class="row-layout">

                        <label for="country"><span class="md-body-2">Select Ingredients 1&nbsp;&nbsp;&nbsp;&nbsp;</span></label>

                        <div>
                          <md-field>
                            <label for="country">Select</label>
                            <md-select v-model="country" name="country" id="country" md-dense>
                              <md-option value="australia">OIL</md-option>
                              <md-option value="brazil">Bean</md-option>
                              <md-option value="japan">Japan</md-option>
                              <md-option value="united-states">United States</md-option>
                            </md-select>
                          </md-field>
                        </div> -->

                        <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                        <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</span></label>

                        <div>
                          <md-field>
                            <label>Quantity</label>
                            <md-input v-model="number" type="number"></md-input>
                          </md-field>
                        </div>

                        <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <div style="width: 14%;">                     
                          <md-field>
                            <label for="font">Select</label>
                            <md-select v-model="font" name="font" id="font" md-dense>
                              <md-option value="arial">GMS</md-option>
                              <md-option value="calibri">MGMS</md-option>
                              <md-option value="cambria">Cambria</md-option>
                            </md-select>
                          </md-field>
                        </div>

                        </div>
                      <div class="row-layout">

                        <label for="country"><span class="md-body-2">Select Ingredients 1&nbsp;&nbsp;&nbsp;&nbsp;</span></label>

                        <div>
                          <md-field>
                            <label for="country">Select</label>
                            <md-select v-model="country" name="country" id="country" md-dense>
                              <md-option value="australia">OIL</md-option>
                              <md-option value="brazil">Bean</md-option>
                              <md-option value="japan">Japan</md-option>
                              <md-option value="united-states">United States</md-option>
                            </md-select>
                          </md-field>
                        </div> -->

                        <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                        <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</span></label> -->

                        <!-- <div>
                          <md-field>
                            <label>Quantity</label>
                            <md-input v-model="number" type="number"></md-input>
                          </md-field>
                        </div>

                        <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <div style="width: 14%;">                     
                          <md-field>
                            <label for="font">Select</label>
                            <md-select v-model="font" name="font" id="font" md-dense>
                              <md-option value="arial">GMS</md-option>
                              <md-option value="calibri">MGMS</md-option>
                              <md-option value="cambria">Cambria</md-option>
                            </md-select>
                          </md-field>
                        </div>

                        </div>
                      <div class="row-layout">

                        <label for="country"><span class="md-body-2">Select Ingredients 1&nbsp;&nbsp;&nbsp;&nbsp;</span></label>

                        <div>
                          <md-field>
                            <label for="country">Select</label>
                            <md-select v-model="country" name="country" id="country" md-dense>
                              <md-option value="australia">OIL</md-option>
                              <md-option value="brazil">Bean</md-option>
                              <md-option value="japan">Japan</md-option>
                              <md-option value="united-states">United States</md-option>
                            </md-select>
                          </md-field>
                        </div> -->

                        <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                        <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;+Qty&nbsp;&nbsp;&nbsp;&nbsp;</span></label> -->

                        <!-- <div>
                          <md-field>
                            <label>Quantity</label>
                            <md-input v-model="number" type="number"></md-input>
                          </md-field>
                        </div>

                        <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <div style="width: 14%;">                     
                          <md-field>
                            <label for="font">Select</label>
                            <md-select v-model="font" name="font" id="font" md-dense>
                              <md-option value="arial">GMS</md-option>
                              <md-option value="calibri">MGMS</md-option>
                              <md-option value="cambria">Cambria</md-option>
                            </md-select>
                          </md-field>
                        </div>

                        </div> -->

                    <!-- <div class="row-layout2"> -->
                    
                      <!-- <div style="display: flex;flex-direction: row;align-items: center;"> -->
                        <!-- <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
                        <!-- <label for="country"><span class="md-body-2">&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;</span></label>
                      <div>
                        <md-field>
                          <label>Quantity</label>
                          <md-input v-model="number" type="number"></md-input>
                        </md-field>
                      </div>

                      <label for="country">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      <div style="width: 18%;">
                        
                        <md-field>
                          <label for="font">Select</label>
                          <md-select v-model="font" name="font" id="font" md-dense>
                            <md-option value="arial">GMS</md-option>
                            <md-option value="calibri">GMS</md-option>
                            <md-option value="cambria">Cambria</md-option>
                          </md-select>
                        </md-field>
                    </div> -->

                    <!-- </div> -->

                    </div>

                

                    
                  </div>
                  <!-- <h5>Pen wise Feed Formula Per Group</h5> -->
                  <hr>
                  <div v-for="(row, index) in rows" :key="index" class="testing">
                    <div class="test1" id="input-item">
                      <label><span class="md-body-2">Select Ingredients</span></label>
                    </div>
                    <div class="test2" id="input-item">
                      <md-field>
                        <label>Select</label>
                        <md-select required v-model="row.country" md-dense>
                          <md-option value="australia">Soya</md-option>
                          <md-option value="brazil">Maize</md-option>
                          <md-option value="japan">7.5 Starter Pre-mix</md-option>
                          <md-option value="united-states">OIL</md-option>
                        </md-select>
                      </md-field>
                    </div>
                    <div class="test3" id="input-item">
                      <label><span class="md-body-2">Qty</span></label>
                    </div>
                    <div class="test4" id="input-item">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="row.number" type="number"></md-input>
                      </md-field>
                    </div>
                    <div class="test5" id="input-item">
                      <md-field>
                        <label>Select</label>
                        <md-select v-model="row.font" md-dense>
                          <md-option value="arial">GMS</md-option>
                          <md-option value="calibri">ML</md-option>
                          <!-- <md-option value="cambria">Cambria</md-option> -->
                        </md-select>
                      </md-field>
                    </div>
                    <div @click="removeRow(row)" style="cursor: pointer;"><md-icon>clear</md-icon></div>
                  </div>
                  <hr>
                    <div class="struct2" style="padding-top: 20px;">
                <div><md-button @click="addRow" class="md-primary">Add Row</md-button> </div>
                        <div class="test2">
                          <md-field>
                            <label><b>Feed Cost</b></label>
                            <md-input v-model="feedCost2" readonly></md-input>
                          </md-field>
                       </div>
                        <label for="country" class="test3"><span class="md-body-2">Total</span></label>
                        <div class="test4">
                          <md-field>
                            <label>Quantity</label>
                            <md-input v-model="number" type="number"></md-input>
                          </md-field>
                        </div>

                        <div class="test5">
                          
                          <md-field>
                            <label for="font">Select</label>
                            <md-select v-model="font" name="font" md-dense>
                              <md-option value="arial">GMS</md-option>
                          <md-option value="calibri">ML</md-option>
                            </md-select>
                          </md-field>
                      </div>
                    </div>

                    <div class="row-layout2">
                    <div id="buttons">
        
                  <div>
                    <div><md-button type="submit" @click="displayAllCategory" class="md-success">Submit</md-button></div>
                  </div>
                  <div style="padding-left: 10px;">
                    <md-button type="button" class="md-danger">Cancel</md-button>
                  </div>
                </div>
                    </div>   

              </md-card-content>
       
              </md-card-content>
            </md-card>  
          </div>    
        </form>
      </div>
      <!-- <div>
        <div class="md-layout md-gutter">
          <div class="md-layout-item">
            <md-field>
                  <label for="movies">Movies</label>
                  <md-select v-model="movies" name="movies" id="movies" md-dense multiple>
                    <md-option value="P1" style="display:contents;">P1</md-option>
                    <md-option value="P2">P2</md-option>
                    <md-option value="P3">P3</md-option>
                    <md-option value="P4">P4</md-option>
                    <md-option value="P5">P5</md-option>
                    <md-option value="P6">P6</md-option>
                    <md-option value="P7">P7</md-option>
                  </md-select>
            </md-field>
          </div>
        </div>
      </div> -->
    </div>
  </template>
  
  <script>
  let id=0;

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
        initial:"T1/10/22",
        feedCost2:'57',
        temp:[{ slNo: 1,ingredients:"Soya",prestarter:"560",starter:"120",finisher:"65",isEditing: false, id: Date.now() + Math.random()},
        { slNo: 2,ingredients:"Maize",prestarter:"560",starter:"120",finisher:"65",isEditing: false, id: Date.now() + Math.random()},
        { slNo: 3,ingredients:"Soya",prestarter:"560",starter:"120",finisher:"65",isEditing: false, id: Date.now() + Math.random()},
        { slNo: 4,ingredients:"7.5StarterPremix",prestarter:"560",starter:"120",finisher:"65",isEditing: false, id: Date.now() + Math.random()},

        ],
        activeTab: 'list', // Default active tab
        rows: [
        { country: '', number: '', font: '' ,id: id++} // Initial row
      ],
        users: [
          { name: 1,ingredients:"Soya", salary: "338", country: "345", city: "366" },
          
          { name: "2", ingredients:"Maize", salary: "738", country: "456", city: "456" },
          { name: "3", ingredients:"7.5 Starter Premix", salary: "142", country: "775", city: "775" },
          { name: "4", ingredients:"7.5 Finisher Premix", salary: "735", country: "889", city: "768" },
          { name: "5", ingredients:"OIL", salary: "542", country: "945", city: "854" },
          // { name: "6", salary: "615", country: "868", city: "665" },
          
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
      addRow(){
        this.rows.push({ country: '', number: '', font: '' });
      },
      removeRow(row){
          this.rows=this.rows.filter((i)=>i!==row);
      },
      setActiveTab(tab) {
        this.activeTab = tab;
      },
      displayAllCategory(){
        this.temp=this.rows;
      },
      toggleEdit(item) {
        item.isEditing = !item.isEditing;
      },
      saveChanges(item) {
        item.isEditing = false;
        // Additional logic to save changes if needed
      },
    }
  };
  </script>
  
  <style scoped>

.styled-tablex {
    width: 100%;
    border-collapse: collapse;
}
.styled-tablex th, .styled-tablex td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    /* width: auto; */
}
.styled-tablex th {
    background-color: #f2f2f2;
    font-size: 16px;
}
.styled-tablex .slct, .styled-tablex .custm {
    width: 100%;
    box-sizing: border-box;
}

.struct{
    display: grid;
    grid-template-columns: 125px 150px 158px 150px;
    grid-gap: 25px;
    grid-auto-rows: 50px; /* Set all rows to 50px height */
}

.md-field {
  margin: 0px 0px;
}

.grid-item {
    height: 50px;
}

.test1 {
    text-align: right;
    /* grid-column: 1 / 5; */
}

.test2 {
    text-align: right;
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
  justify-content: space-between;
}

hr {
            border: none;
            height: 2px;
            background-color: #000;
            margin-top: 25px;
        }

.custom-md-field{
  /* Adjust the overall size of the md-field if needed */
  width: 190px; /* Adjust as needed */
}

.struct2{
  display: grid;
    grid-template-columns: 135px 250px 58px 150px 100px;
    grid-gap: 25px;
    grid-auto-rows: 50px;
    margin-left:20px; 
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

/* Ensure proper display of checkboxes beside text in md-select */
.md-select-list-item {
  display: flex;
  align-items: center;
}

.md-select-list-item .md-checkbox {
  margin-right: 200px;
}
.card-box {
    background-color: #fff;
    /* padding: rem 0rem 0rem 0rem; */
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
    width: 82%;
  }

  .form-style{
    display:flex;
    flex-direction:column;
    align-items:center;
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
  }
  </style>
  