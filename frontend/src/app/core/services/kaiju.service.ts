import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';

@Injectable({
  providedIn: 'root',
})
export class KaijuService {
  constructor(private readonly api: ApiService) {}

  getAll(): Observable<unknown> {
    return this.api.get('/kaijus');
  }

  getOne(id: string | number): Observable<unknown> {
    return this.api.get(`/kaijus/${id}`);
  }

  getBuild(id: string | number, params: { hp: number; speed: number; damage: number; regen: number }): Observable<unknown> {
    const search = new URLSearchParams({
      hp: String(params.hp),
      speed: String(params.speed),
      damage: String(params.damage),
      regen: String(params.regen),
    });

    return this.api.get(`/kaijus/${id}/build?${search.toString()}`);
  }
}
