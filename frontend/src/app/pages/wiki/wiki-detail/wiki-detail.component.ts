import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { KaijuService } from '../../../core/services/kaiju.service';

@Component({
  selector: 'app-wiki-detail',
  standalone: true,
  templateUrl: './wiki-detail.component.html',
  styleUrl: './wiki-detail.component.css',
})
export class WikiDetailComponent implements OnInit {
  kaiju: any;

  constructor(private readonly route: ActivatedRoute, private readonly kaijuService: KaijuService) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (!id) {
      return;
    }

    this.kaijuService.getOne(id).subscribe((data: any) => {
      this.kaiju = data?.data ?? data;
    });
  }
}
