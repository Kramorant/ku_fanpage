import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';

@Injectable({
  providedIn: 'root',
})
export class EventService {
  constructor(private readonly api: ApiService) {}

  getAll(): Observable<unknown> {
    return this.api.get('/events');
  }

  getOne(id: string | number): Observable<unknown> {
    return this.api.get(`/events/${id}`);
  }
}
