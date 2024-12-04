export default [
  {
    component: 'CNavItem',
    name: 'Dashboard',
    to: '/dashboard',
    icon: 'cil-speedometer',
    // badge: {
    //   color: 'primary',
    //   text: 'NEW',
    // },
  },
  {
    component: 'CNavTitle',
    name: 'Asset Management',
  },
  {
    component: 'CNavItem',
    name: 'Service Details',
    to: '/service/service-details',
    icon: 'cil-laptop',
  },
  {
    component: 'CNavItem',
    name: 'Payment Details',
    to: '/payment/payment-details',
    icon: 'cil-dollar',
  },
  {
    component: 'CNavItem',
    name: 'Dealers Payment Details',
    to: '/payment/dealers-payment-details',
    icon: 'cil-dollar',
  },
  {
    component: 'CNavItem',
    name: 'Customer Details',
    to: '/customer/customer-details',
    icon: 'cil-people',
  },
  {
    component: 'CNavTitle',
    name: 'Masters',
  },
  {
    component: 'CNavItem',
    name: 'Dealers',
    to: '/master/dealers',
    icon: 'cil-contact',
  },
  {
    component: 'CNavItem',
    name: 'User Management',
    to: '/user/user-management',
    icon: 'cil-contact',
  },
  {
    component: 'CNavTitle',
    name: 'Settings',
  },
  {
    component: 'CNavItem',
    name: 'User Profile',
    to: '/user/user-profile',
    icon: 'cil-user',
  },
]
