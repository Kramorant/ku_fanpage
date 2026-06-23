import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, tap } from 'rxjs';
import { ApiService } from './api.service';

interface AuthUser {
  id: number;
  name: string;
  email: string;
  is_admin?: boolean;
}

interface AuthResponse {
  token: string;
  user: AuthUser;
}

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private readonly tokenKey = 'auth_token';
  readonly currentUser$ = new BehaviorSubject<AuthUser | null>(null);

  constructor(private readonly api: ApiService) {}

  login(email: string, password: string): Observable<AuthResponse> {
    return this.api.post<AuthResponse>('/login', { email, password }).pipe(
      tap((response) => {
        localStorage.setItem(this.tokenKey, response.token);
        this.currentUser$.next(response.user);
      })
    );
  }

  register(name: string, email: string, password: string): Observable<AuthResponse> {
    return this.api.post<AuthResponse>('/register', { name, email, password }).pipe(
      tap((response) => {
        localStorage.setItem(this.tokenKey, response.token);
        this.currentUser$.next(response.user);
      })
    );
  }

  logout(): Observable<{ message: string }> {
    return this.api.post<{ message: string }>('/logout', {}).pipe(
      tap(() => {
        localStorage.removeItem(this.tokenKey);
        this.currentUser$.next(null);
      })
    );
  }

  token(): string | null {
    return localStorage.getItem(this.tokenKey);
  }

  isLoggedIn(): boolean {
    return !!this.token();
  }

  isAdmin(): boolean {
    return !!this.currentUser$.value?.is_admin;
  }
}
