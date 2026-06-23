import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';

@Injectable({
  providedIn: 'root',
})
export class BlogService {
  constructor(private readonly api: ApiService) {}

  getAll(): Observable<unknown> {
    return this.api.get('/blog');
  }

  getOne(id: string | number): Observable<unknown> {
    return this.api.get(`/blog/${id}`);
  }
}
