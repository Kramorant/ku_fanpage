import { Component, OnInit } from '@angular/core';
import { NgFor } from '@angular/common';
import { RouterLink } from '@angular/router';
import { KaijuService } from '../../../core/services/kaiju.service';

@Component({
  selector: 'app-wiki-list',
  standalone: true,
  imports: [NgFor, RouterLink],
  templateUrl: './wiki-list.component.html',
  styleUrl: './wiki-list.component.css',
})
export class WikiListComponent implements OnInit {
  kaijus: any[] = [];

  constructor(private readonly kaijuService: KaijuService) {}

  ngOnInit(): void {
    this.kaijuService.getAll().subscribe((data: any) => {
      this.kaijus = data?.data ?? [];
    });
  }
}
