import { Component, OnInit } from '@angular/core';
import { NgFor, LowerCasePipe } from '@angular/common';
import { CdkDragDrop, DragDropModule, moveItemInArray, transferArrayItem } from '@angular/cdk/drag-drop';
import html2canvas from 'html2canvas';
import { KaijuService } from '../../core/services/kaiju.service';

@Component({
  selector: 'app-tierlist',
  standalone: true,
  imports: [NgFor, DragDropModule, LowerCasePipe],
  templateUrl: './tierlist.component.html',
  styleUrl: './tierlist.component.css',
})
export class TierlistComponent implements OnInit {
  tiers = ['S', 'A', 'B', 'C', 'D'];
  tierItems: Record<string, any[]> = { S: [], A: [], B: [], C: [], D: [] };
  unplacedKaijus: any[] = [];

  constructor(private readonly kaijuService: KaijuService) {}

  ngOnInit(): void {
    this.kaijuService.getAll().subscribe((data: any) => {
      this.unplacedKaijus = data?.data ?? [];
    });
  }

  drop(event: CdkDragDrop<any[]>): void {
    if (event.previousContainer === event.container) {
      moveItemInArray(event.container.data, event.previousIndex, event.currentIndex);
      return;
    }

    transferArrayItem(event.previousContainer.data, event.container.data, event.previousIndex, event.currentIndex);
  }

  async downloadAsPng(): Promise<void> {
    const tierlistElement = document.getElementById('tierlist-board');
    if (!tierlistElement) {
      return;
    }

    const canvas = await html2canvas(tierlistElement);
    const link = document.createElement('a');
    link.download = 'kaiju-tierlist.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
  }
}
