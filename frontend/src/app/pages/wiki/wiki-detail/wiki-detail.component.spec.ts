import { TestBed } from '@angular/core/testing';
import { WikiDetailComponent } from './wiki-detail.component';
import { appTestProviders } from '../../../testing-setup';

describe('WikiDetailComponent', () => {
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [WikiDetailComponent],
      providers: [...appTestProviders],
    }).compileComponents();
  });

  it('should create', () => {
    const fixture = TestBed.createComponent(WikiDetailComponent);
    const component = fixture.componentInstance;
    expect(component).toBeTruthy();
  });
});
