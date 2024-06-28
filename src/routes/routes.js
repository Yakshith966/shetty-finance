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
import TrialGroup from "@/pages/Master/TrialGroup.vue";
import BatchMaster from "@/pages/Master/BatchMaster.vue";
import FeedIngredient from "@/pages/Master/FeedIngredient.vue";
import FeederDrumMaster from "@/pages/Master/FeederDrumMaster.vue";
import CrateMaster from "@/pages/Master/CrateMaster.vue";
import Feeder from "@/pages/Master/Feeder.vue";
import GroupwiseWeight from "@/pages/Reports/GroupwiseWeight.vue";
import BirdRatio from "@/pages/Reports/BirdRatio.vue";
import PenwiseWeight from "@/pages/Reports/PenwiseWeight.vue";
import WeeklyReport from "../pages/Reports/WeeklyReport.vue";
import Weight5thWeek from "../pages/Reports/Weight5thWeek.vue";
import MortalDetails from "../pages/Reports/MortalDetails.vue";
import AllocationGroupwiseTare from "../pages/AllocationGroupwiseTare.vue";


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
        path: "allocationgroupwisetare",
        name: "Allocation Groupwise Tare",
        component: AllocationGroupwiseTare,
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
        path: "mortaldetails",
        name: "Mortal Details",
        component: MortalDetails,
      },
      {
        path: "penwiseweight",
        name: "Penwise Male/Female Bird's Body Weight on 5th Week",
        component: PenwiseWeight,
      },
      {
        path: "weeklyreport",
        name: "Weekly Penwise Report",
        component: WeeklyReport,
      },
      {
        path: "weight5thweek",
        name: "Bird Weight on 5th Week",
        component: Weight5thWeek,
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