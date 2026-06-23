import { Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { WikiListComponent } from './pages/wiki/wiki-list/wiki-list.component';
import { WikiDetailComponent } from './pages/wiki/wiki-detail/wiki-detail.component';
import { EventsComponent } from './pages/events/events.component';
import { BlogListComponent } from './pages/blog/blog-list/blog-list.component';
import { BlogDetailComponent } from './pages/blog/blog-detail/blog-detail.component';
import { TierlistComponent } from './pages/tierlist/tierlist.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';

export const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'wiki', component: WikiListComponent },
  { path: 'wiki/:id', component: WikiDetailComponent },
  { path: 'events', component: EventsComponent },
  { path: 'blog', component: BlogListComponent },
  { path: 'blog/:id', component: BlogDetailComponent },
  { path: 'tierlist', component: TierlistComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
];
