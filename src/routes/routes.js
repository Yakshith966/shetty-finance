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
import TrialGroup from "@/pages/Master/TrialGroup.vue";
import BatchMaster from "@/pages/Master/BatchMaster.vue";
import FeedIngredient from "@/pages/Master/FeedIngredient.vue";
import FeederDrumMaster from "@/pages/Master/FeederDrumMaster.vue";
import CrateMaster from "@/pages/Master/CrateMaster.vue";
import Feeder from "@/pages/Master/Feeder.vue";
import GroupwiseWeight from "@/pages/Reports/GroupwiseWeight.vue";
import BirdRatio from "@/pages/Reports/BirdRatio.vue";
import PenwiseWeight from "@/pages/Reports/PenwiseWeight.vue";

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
        path: "trialgroup",
        name: "Trial Group",
        component: TrialGroup,
      },
      {
        path: "batchmaster",
        name: "Batch Master",
        component: BatchMaster,
      },
      {
        path: "feedingredient",
        name: "Feed Ingredient",
        component: FeedIngredient,
      },
      {
        path: "feederdrummaster",
        name: "Feeder Drum Master",
        component: FeederDrumMaster,
      },
      {
        path: "feeder",
        name: "Feeder",
        component: Feeder,
      },
      {
        path: "cratemaster",
        name: "Crate Master",
        component: CrateMaster,
      },
      {
        path: "groupwiseweight",
        name: "Groupwise Male/Female Bird's Body Weight at 5th Week",
        component: GroupwiseWeight,
      },
      {
        path: "birdratio",
        name: "Male/Female Bird Ratio As Equal Numbers",
        component: BirdRatio,
      },
      {
        path: "penwiseweight",
        name: "Penwise Male/Female Bird's Body Weight on 5th Week",
        component: PenwiseWeight,
      },
      {
        path: "usermanagement",
        name: "Usermanagement",
        component: Usermanagement,
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