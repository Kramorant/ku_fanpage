import { Component, OnInit } from '@angular/core';
import { NgFor, NgIf } from '@angular/common';
import { EventService } from '../../core/services/event.service';

@Component({
  selector: 'app-events',
  standalone: true,
  imports: [NgFor, NgIf],
  templateUrl: './events.component.html',
  styleUrl: './events.component.css',
})
export class EventsComponent implements OnInit {
  events: any[] = [];

  constructor(private readonly eventService: EventService) {}

  ngOnInit(): void {
    this.eventService.getAll().subscribe((data: any) => {
      this.events = data?.data ?? [];
    });
  }
}
