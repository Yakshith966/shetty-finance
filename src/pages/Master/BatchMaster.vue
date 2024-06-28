<template>
  <div>
    <div class="card-box">
      <div class="row align-items-center mb-3">
        <div class="col">
          <h4 class="mt-0 header-title">TRIAL GROUP MASTER</h4>
        </div>

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

    <div v-if="activeTab === 'list'">
      <div class="row align-items-center mb-3">
        <div class="col">
          <md-field class="custom-md-field">
            <label for="movie">show</label>
            <md-select
              v-model="movie"
              name="movie"
              id="movie"
              class="custom-md-input"
            >
              <md-option value="5">5</md-option>
              <md-option value="10">10</md-option>
              <md-option value="15">15</md-option>
              <md-option value=" ">All</md-option>
            </md-select>
          </md-field>
        </div>

        <md-field class="custom-md-field" style="margin: 0px 0px 0px 0px">
          <label>Search...</label>
          <md-input v-model="initial"></md-input>
        </md-field>
        <md-icon>search</md-icon>
      </div>

      <div
        class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
      >
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">BATCH MASTERS</h4>
            <!-- <p class="category">List of Users</p> -->
          </md-card-header>
          <md-card-content>
            <md-table
              v-model="users"
              :table-header-color="tableHeaderColor"
              class="custom-table"
            >
              <tr>
                <th>Sl No</th>
                <th>Batch Id</th>
                <th>Batch Name/Code</th>
              </tr>

              <tr v-for="item in users" :key="item.Sl_no">
                <td>{{ item.Sl_no }}</td>
                <td>{{ item.id }}</td>
                <td>{{ item.code }}</td>
              </tr>
            </md-table>
          </md-card-content>
        </md-card>
      </div>
    </div>

    <div v-if="activeTab === 'apply'" class="mt-3">
      <form>
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
        >
          <md-card style="width: 55%">
            <md-card-header data-background-color="green">
              <h4 class="title">BATCH MASTER</h4>
              <!-- <p class="category">Complete your profile</p> -->
            </md-card-header>
            <md-card-content>
              <div class="form-group">
                <!-- <label for="employeeName">Employee Name<span>*</span></label> -->
                <!-- <md-field>
                        <md-select v-model="country" name="country" id="country" placeholder="Select employee">
                            <md-option value="australia">Raju</md-option>
                            <md-option value="brazil">Sham</md-option>
                            <md-option value="japan">Suresh</md-option>
                            <md-option value="united-states">Rahul</md-option>
                        </md-select>
                    </md-field> -->
              </div>

              <!-- Confirm Password -->
              <div class="form-group">
                <md-field>
                  <label>Batch Id</label>
                  <md-input v-model="id" type="id"></md-input>
                </md-field>
              </div>

              <!-- Email -->
              <div class="form-group">
                <md-field>
                  <label>Batch Name/Code</label>
                  <md-input v-model="name" type="name"></md-input>
                </md-field>
              </div>

              <!-- Buttons -->
              <div id="buttons">
                <!-- <button  class="save-button">Save</button> -->
                <!-- <md-button  class="md-success">Save</md-button> -->
                <div>
                  <md-button type="submit" class="md-success">Save</md-button>
                </div>
                <div style="padding-left: 10px">
                  <md-button type="button" class="md-danger">Cancel</md-button>
                </div>
              </div>
            </md-card-content>
          </md-card>
        </div>
      </form>
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
      activeTab: "list", // Default active tab
      users: [
        { Sl_no: "1", id: "B001", code: "*B-27" },
        { Sl_no: "2", id: "B002", code: "*B-28" },
        { Sl_no: "3", id: "B003", code: "*B-29" },
        { Sl_no: "4", id: "B004", code: "*B-30" },
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
  },
};
</script>

<style scoped>
.custom-md-field {
  /* Adjust the overall size of the md-field if needed */
  width: 190px;
  /* Adjust as needed */
}

.custom-md-input {
  /* Adjust the size of the input */
  width: 50px;
  /* Change the width as needed */
  /* height: 30px; Change the height as needed */
  /*padding: 5px;  Adjust padding as needed */
  font-size: 14px;
  /* Adjust font size as needed */
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

.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
  color: #fff !important;
  background-color: #71b6f9 !important;
}

.align-items-center {
  align-items: center !important;
  padding: 0px 65px 0px 20px;
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

.card-box {
  background-color: #fff;
  padding: 1.2rem 0rem 0.2rem 0rem;
  /* list/create */
  -webkit-box-shadow: 0 0.75rem 6rem rgba(56, 65, 74, 0.03);
  box-shadow: 0 0.75rem 6rem rgba(56, 65, 74, 0.03);
  margin-bottom: 1px;
  border-radius: 0.25rem;
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
  display: inline;
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
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out;
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

ol,
ul,
dl {
  margin-top: 0;
  margin-bottom: 1rem;
}

.create-field {
  display: flex;
  flex-direction: column;
  align-items: left;
}

.all-buttons {
  display: flex;
  flex-direction: row;
  padding: 5px 10px;
}
</style>