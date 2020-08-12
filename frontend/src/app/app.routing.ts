import { NgModule } from '@angular/core';
import { CommonModule, } from '@angular/common';
import { BrowserModule  } from '@angular/platform-browser';
import { Routes, RouterModule } from '@angular/router';

import { ComponentsComponent } from './components/components.component';
import { LandingComponent } from './customer/landing/landing.component';
import { LoginComponent } from './customer/login/login.component';
import { ProfileComponent } from './customer/profile/profile.component';
import { PricingComponent } from './customer/pricing/pricing.component';
import { DashboardComponent } from './customer/dashboard/dashboard.component';
import { NucleoiconsComponent } from './components/nucleoicons/nucleoicons.component';
import { CommercialComponent } from './customer/commercial/commercial.component';
import { ReferfriendComponent } from './customer/referfriend/referfriend.component';
import { TrackDriverComponent } from './customer/track-driver/track-driver.component';
const routes: Routes =[
    // { path: '', redirectTo: '', pathMatch: 'full' },
    { path: '',            component: LandingComponent },
    { path: 'index',       component: ComponentsComponent },
    { path: 'nucleoicons', component: NucleoiconsComponent },
    { path: 'login',       component: LoginComponent },
    { path: 'profile',     component: ProfileComponent },
    { path: 'pricing',     component: PricingComponent },
    { path: 'dashboard',     component: DashboardComponent },
    { path: 'commercial',     component:  CommercialComponent},
    { path: 'refer-to-friend',     component:  ReferfriendComponent},
    { path: 'track-driver',     component:  TrackDriverComponent},
];

@NgModule({
    imports: [
        CommonModule,
        BrowserModule,
        RouterModule.forRoot(routes),
    ],
    exports: [
    ],
})
export class AppRoutingModule { }
