import { TestBed } from '@angular/core/testing';
import { BlogDetailComponent } from './blog-detail.component';
import { appTestProviders } from '../../../testing-setup';

describe('BlogDetailComponent', () => {
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [BlogDetailComponent],
      providers: [...appTestProviders],
    }).compileComponents();
  });

  it('should create', () => {
    const fixture = TestBed.createComponent(BlogDetailComponent);
    const component = fixture.componentInstance;
    expect(component).toBeTruthy();
  });
});
