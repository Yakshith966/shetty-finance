import DashboardLayout from "@/pages/Layout/DashboardLayout.vue";

import Dashboard from "@/pages/Dashboard.vue";
import UserProfile from "@/pages/UserProfile.vue";
import TableList from "@/pages/TableList.vue";
import Typography from "@/pages/Typography.vue";
import Icons from "@/pages/Icons.vue";
import Maps from "@/pages/Maps.vue";
import Notifications from "@/pages/Notifications.vue";
import UpgradeToPRO from "@/pages/UpgradeToPRO.vue";
import Usermanagement from "@/pages/Usermanagement.vue";
import LoginView from "@/pages/Auth/LoginView.vue";
import FeedFormula from "@/pages/FeedFormula.vue";
import PreStarter from "@/pages/PreStarter.vue";
import Experimentinfo from "@/pages/ExperimentInfo.vue";
import DataScreenEntry from "@/pages/DataScreenEntry.vue";
import BodyWeight from "@/pages/BodyWeight.vue";
import BaseFeedFormula from "@/pages/BaseFeedFormula.vue";

const routes = [
  {
    path: "/login",
    name: "Login",
    component: LoginView,
  },
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/dashboard",
    children: [
      {
        path: "dashboard",
        name: "Dashboard",
        component: Dashboard,
      },
      {
        path: "usermanagement",
        name: "Usermanagement",
        component: Usermanagement,
      },
      {
        path: "experimentinfo",
        name: "Experiment Info",
        component: Experimentinfo,
      },
      {
        path: "feedformula",
        name: "Feed Formula",
        component: FeedFormula,
      },
      {
        path: "prestarter",
        name: "Prestarter",
        component: PreStarter,
      },
      {
        path: "Datascreenentry",
        name: "Data Screen Entry",
        component: DataScreenEntry,
      },
      {
        path: "Bodyweightview",
        name: "Body weight view",
        component: BodyWeight,
      },
      {
        path: "BaseFeedFormula",
        name: "Base Feed Formula",
        component: BaseFeedFormula,
      },
      {
        path: "user",
        name: "User Profile",
        component: UserProfile,
      },
      {
        path: "table",
        name: "Table List",
        component: TableList,
      },
      {
        path: "typography",
        name: "Typography",
        component: Typography,
      },
      {
        path: "icons",
        name: "Icons",
        component: Icons,
      },
      {
        path: "maps",
        name: "Maps",
        meta: {
          hideFooter: true,
        },
        component: Maps,
      },
      {
        path: "notifications",
        name: "Notifications",
        component: Notifications,
      },
      {
        path: "upgrade",
        name: "Upgrade to PRO",
        component: UpgradeToPRO,
      },
    ],
  },
];

export default routes;